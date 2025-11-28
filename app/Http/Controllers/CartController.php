<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Pedido;
use App\Models\Categoria; // Importat per si de cas
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Stripe\Stripe;
use Stripe\Checkout\Session as StripeCheckoutSession;
use Stripe\Exception\ApiErrorException;

class CartController extends Controller
{
    /**
     * Muestra la página del carrito.
     */
    public function index()
    {
        $cart = session()->get('cart', []);
        $total = array_sum(array_map(fn($item) => ($item['precio'] ?? 0) * ($item['cantidad'] ?? 0), $cart));
        return view('public.cart', compact('cart', 'total'));
    }

    /**
     * Añade un producto al carrito.
     */
    public function add(Request $request, Producto $producto)
    {
        if (!$producto->activo) {
            if ($request->wantsJson()) {
                return response()->json(['error' => 'Aquest producte no està disponible.'], 422);
            }
            return back()->with('error', 'Aquest producte no està disponible.');
        }

        $cantidad = (int) $request->input('cantidad', 1);

        $cart = session()->get('cart', []);

        if (isset($cart[$producto->id])) {
            $cart[$producto->id]['cantidad'] += $cantidad;
        } else {
            $cart[$producto->id] = [
                'nombre' => $producto->nombre,
                'precio' => $producto->precio,
                'cantidad' => $cantidad,
                'imagen' => $producto->imagen
            ];
        }

        session()->put('cart', $cart);

        // Calculate total items count
        $cartCount = array_sum(array_column($cart, 'cantidad'));

        if ($request->wantsJson()) {
            return response()->json([
                'success' => 'Producto añadido al carrito.',
                'cartCount' => $cartCount
            ]);
        }

        return redirect()->back()->with('success', 'Producto añadido al carrito.');
    }


    /**
     * Actualiza la cantidad de un producto.
     */
    public function update(Request $request, Producto $producto)
    {
         $request->validate(['cantidad' => 'required|integer|min:1']);
        $cart = session()->get('cart', []);
        $cantidad = (int)$request->cantidad;

        if (isset($cart[$producto->id])) {
            if ($cantidad > 0) {
                $cart[$producto->id]['cantidad'] = $cantidad;
            } else {
                unset($cart[$producto->id]); // Eliminar si la cantidad es 0 o menos
            }
            session()->put('cart', $cart);
        }

        if ($request->wantsJson()) {
            // Recalculate totals
            $total = array_sum(array_map(fn($item) => ($item['precio'] ?? 0) * ($item['cantidad'] ?? 0), $cart));
            $cartCount = array_sum(array_column($cart, 'cantidad'));
            
            return response()->json([
                'success' => 'Carrito actualizado.',
                'total' => number_format($total, 2, ',', '.'),
                'cartCount' => $cartCount
            ]);
        }

        return redirect()->back()->with('success', 'Carrito actualizado.');
    }

    /**
     * Elimina un producto del carrito.
     */
     public function remove(Producto $producto)
     {
         $cart = session()->get('cart', []);
         if (isset($cart[$producto->id])) {
             unset($cart[$producto->id]);
             session()->put('cart', $cart);
         }
         return redirect()->back()->with('success', 'Producto eliminado del carrito.');
     }

    /**
     * Vacía todo el carrito.
     */
     public function clear()
     {
         session()->forget('cart');
         return redirect()->back()->with('success', 'Carrito vaciado.');
     }

    /**
     * Muestra la página de checkout.
     */
     public function checkout()
     {
         $cart = session()->get('cart', []);
         if (empty($cart)) {
             return redirect()->route('public.menu')->with('error', 'El teu carret està buit.');
         }
         $total = array_sum(array_map(fn($item) => ($item['precio'] ?? 0) * ($item['cantidad'] ?? 0), $cart));
         return view('public.checkout', compact('cart', 'total'));
     }

    /**
     * Inicia el proceso de pago con Stripe.
     */
    public function startCheckout(Request $request)
    {
        // 1. Validar dades del client
        $validatedData = $request->validate([
            'cliente_nombre' => 'required|string|max:255',
            'cliente_email' => 'required|email|max:255', // Es buena idea pedir el email
            'cliente_telefono' => 'required|string|max:20',
            'notas' => 'nullable|string|max:1000',
        ]);

        // 2. Obtenir carret
        $cart = session('cart', []);
        if (empty($cart)) {
            return redirect()->route('public.menu')->with('error', 'El teu carret està buit.');
        }

        // 3. Configurar Stripe
        $stripeSecret = env('STRIPE_SECRET');
        if (!$stripeSecret) {
            Log::error('La clau STRIPE_SECRET no està configurada al fitxer .env.');
            return back()->with('error', 'Error de configuració del pagament. Contacta amb l\'administrador.');
        }
        Stripe::setApiKey($stripeSecret);
        Stripe::setApiVersion('2024-06-20');

        // 4. Preparar los items para Stripe
        $lineItems = [];
        foreach ($cart as $id => $details) {
             if (!isset($details['precio']) || !isset($details['cantidad']) || !isset($details['nombre'])) {
                 Log::error('Dades incompletes al carret per al producte ID: ' . $id, ['details' => $details]);
                 return back()->with('error', 'Hi ha hagut un problema amb les dades del carret.');
             }
            $lineItems[] = [
                'price_data' => [
                    'currency' => 'eur',
                    'unit_amount' => round(($details['precio'] ?? 0) * 100), // Stripe usa céntimos
                    'product_data' => [
                        'name' => $details['nombre'],
                    ],
                ],
                'quantity' => $details['cantidad'] ?? 1,
            ];
        }

        // 5. Definir URLs de retorn
        $successUrl = route('cart.payment.success') . '?session_id={CHECKOUT_SESSION_ID}';
        $cancelUrl = route('cart.payment.cancel');

        // 6. Crear la Sessió de Checkout a Stripe
        try {
            Log::info('Intentant crear sessió de Stripe...');
            $checkout_session = StripeCheckoutSession::create([
                'payment_method_types' => ['card'],
                'line_items' => $lineItems,
                'mode' => 'payment',
                'success_url' => $successUrl,
                'cancel_url' => $cancelUrl,
                'customer_email' => $validatedData['cliente_email'],
                'metadata' => [
                    'cliente_nombre' => $validatedData['cliente_nombre'],
                    'cliente_telefono' => $validatedData['cliente_telefono'],
                    'notas' => $validatedData['notas'] ?? '',
                ]
            ]);
            Log::info('Sessió de Stripe creada amb èxit.', ['session_id' => $checkout_session->id]);

            // 7. Redirigir a la pàgina de pagament de Stripe
            return redirect($checkout_session->url, 303);

        } catch (ApiErrorException $e) {
            Log::error('Error API Stripe creant sessió: ' . $e->getMessage(), [
                'stripe_code' => $e->getStripeCode(),
                'stripe_param' => $e->getStripeParam(),
            ]);
            return back()->with('error', 'No s\'ha pogut iniciar el procés de pagament.');
        } catch (\Exception $e) {
             Log::error('Error inesperat durant inici checkout Stripe: ' . $e->getMessage());
            return back()->with('error', 'Hi ha hagut un error inesperat.');
        }
    }


    /**
     * Gestiona el retorno exitoso de Stripe.
     * VERSIÓ MODIFICADA PER MOSTRAR L'ERROR REAL
     */
    public function paymentSuccess(Request $request)
    {
        $stripeSessionId = $request->query('session_id');
        Log::info('Accedint a paymentSuccess.', ['session_id_query' => $stripeSessionId]);

        if (!$stripeSessionId) {
            Log::warning('Retorn de Stripe sense session_id.');
            return redirect()->route('cart.index')->with('error', 'Falta l\'identificador de la sessió de pagament.');
        }

        $stripeSecret = env('STRIPE_SECRET');
        if (!$stripeSecret) { 
            Log::error('La clau STRIPE_SECRET no està configurada per a paymentSuccess.');
            return redirect()->route('cart.index')->with('error', 'Error de configuració del pagament.');
        }
        Stripe::setApiKey($stripeSecret);
        Stripe::setApiVersion('2024-06-20');

        try {
            $checkout_session = StripeCheckoutSession::retrieve($stripeSessionId);
            Log::info('Sessió de Stripe recuperada.', ['payment_status' => $checkout_session->payment_status]);

            // Comprovar si el pedido ja fue procesado
            $pedidoExistente = Pedido::where('stripe_session_id', $checkout_session->id)->first();
            if ($pedidoExistente) {
                Log::warning('Intent de processar un pedido ja existent.', ['pedido_id' => $pedidoExistente->id]);
                session()->forget('cart');
                return redirect()->route('cart.thankyou', $pedidoExistente->id)
                                ->with('success', 'Pagament completat i comanda realitzada amb èxit!');
            }

            // Comprobamos el estado del PAGO
            if ($checkout_session->payment_status == 'paid') {
                Log::info('Pagament confirmat com "paid".');

                $checkoutData = [
                    'cliente_nombre' => $checkout_session->metadata->cliente_nombre ?? $checkout_session->customer_details->name,
                    'cliente_email' => $checkout_session->customer_details->email,
                    'cliente_telefono' => $checkout_session->metadata->cliente_telefono ?? 'N/A',
                    'notas' => $checkout_session->metadata->notas ?? null,
                ];
                
                $cart = session('cart');

                if (empty($cart)) {
                    Log::error('Carret no trobat a la sessió (paymentSuccess).', ['session_id' => $stripeSessionId]);
                    return redirect()->route('public.inicio')->with('error', 'Hem rebut el pagament, però no hem pogut recuperar el teu carret. Contacta amb nosaltres.');
                }

                Log::info('Dades de Stripe i carret recuperats. Cridant a _placeOrder...');
                
                // Cridem a _placeOrder
                $resultat = $this->_placeOrder(
                    $checkoutData,
                    $cart,
                    $checkout_session->id,
                    $checkout_session->payment_intent,
                    $checkout_session->amount_total / 100
                );

                // --- NOVA COMPROVACIÓ ---
                // Comprovem si el resultat és un objecte Pedido (ÈXIT)
                // o un string (ERROR)
                
                if ($resultat instanceof Pedido) {
                    // ÈXIT! $resultat ÉS un objecte Pedido
                    $pedido = $resultat;
                    Log::info('Comanda creada amb èxit a la BBDD.', ['pedido_id' => $pedido->id]);
                    session()->forget('cart');
                    return redirect()->route('cart.thankyou', $pedido->id)
                                    ->with('success', 'Pagament completat i comanda realitzada amb èxit!');
                } else {
                    // FALLADA! $resultat ÉS un STRING amb l'error
                    $errorMessage = (string) $resultat; // Conté el missatge d'error real
                    
                    Log::error('Error retornat per _placeOrder (missatge ara visible): ' . $errorMessage, ['session_id' => $stripeSessionId]);
                    
                    // Mostrem l'error real a l'usuari
                    // NOTA: Cal assegurar-se que la vista pot renderitzar HTML. Si fas servir {{ $message }},
                    // canvia-ho a {!! $message !!} a la vista del 'with('error', ...)'
                    return redirect()->route('cart.index')->with('error', 
                        'El pagament s\'ha realitzat, però hi ha hagut un error al guardar la comanda. 
                        <br><strong>DETALL:</strong> ' . htmlspecialchars($errorMessage) . 
                        ' <br>(Ref: ' . htmlspecialchars($stripeSessionId) . ').'
                    );
                }
                // --- FI DE LA NOVA COMPROVACIÓ ---

            } else {
                Log::warning('Sessió Stripe recuperada però el pagament NO és "paid".', ['payment_status' => $checkout_session->payment_status]);
                return redirect()->route('cart.index')->with('error', 'El pagament no s\'ha completat correctament segons Stripe.');
            }

        } catch (ApiErrorException $e) {
            Log::error('Error API Stripe recuperant sessió: ' . $e->getMessage(), ['session_id' => $stripeSessionId]);
            return redirect()->route('cart.index')->with('error', 'No s\'ha pogut verificar l\'estat del pagament.');
        } catch (\Exception $e) {
            Log::error('Error INESPERAT durant confirmació pagament: ' . $e->getMessage(), ['trace' => $e->getTraceAsString()]);
            return redirect()->route('cart.index')->with('error', 'Hi ha hagut un error inesperat al confirmar el pagament.');
        }
    }


    /**
     * Gestiona la cancelación del pago en Stripe.
     */
    public function paymentCancel(Request $request)
    {
        Log::info('Pagament cancel·lat per l\'usuari.', ['query' => $request->query()]);
        return redirect()->route('cart.index')->with('info', 'El procés de pagament ha estat cancel·lat.');
    }


    /**
     * Método privado para crear el pedido en la base de datos.
     * VERSIÓ MODIFICADA: Retorna Pedido (èxit) o String (error)
     */
    private function _placeOrder(array $validatedData, array $cart, string $stripeSessionId, string $paymentIntentId, float $total)
    {
        $pedido = null; // Variable per emmagatzemar el pedido creat
        
        try {
            DB::transaction(function () use ($validatedData, $cart, $total, $stripeSessionId, $paymentIntentId, &$pedido) {
                
                Log::info('Iniciant transacció per crear comanda...');
                
                $pedido = Pedido::create([
                    'cliente_nombre' => $validatedData['cliente_nombre'],
                    'cliente_email' => $validatedData['cliente_email'] ?? null,
                    'cliente_telefono' => $validatedData['cliente_telefono'],
                    'precio_total' => $total,
                    'estado' => 'Pagado',
                    'notas' => $validatedData['notas'] ?? null,
                    'stripe_session_id' => $stripeSessionId,
                    'stripe_payment_intent_id' => $paymentIntentId,
                ]);
                Log::info('Comanda principal creada.', ['pedido_id' => $pedido->id]);

                $productosParaAdjuntar = [];
                foreach ($cart as $producto_id => $item) {
                    $producto = Producto::find($producto_id); 
                    if ($producto) {
                        Log::info('Preparant producte per adjuntar.', ['pedido_id' => $pedido->id, 'producto_id' => $producto_id]);
                        $productosParaAdjuntar[$producto_id] = [
                            'cantidad' => $item['cantidad'] ?? 1,
                            'precio_unitario' => $item['precio'] ?? 0,
                        ];
                    } else {
                         Log::warning("Producte ID $producto_id no trobat dins la transacció _placeOrder.", ['pedido_id' => $pedido->id ?? 'N/A']);
                         // Llancem un error per forçar el rollback de la transacció
                         throw new \Exception("Producte ID $producto_id no encontrado. Abortando transacción.");
                    }
                }
                
// Substituïm el 'attach()' per una inserció manual
// per evitar problemes amb els timestamps (created_at)
Log::info('Adjuntant productes manualment...');
foreach ($productosParaAdjuntar as $producto_id => $attributes) {
    DB::table('pedido_producto')->insert([
        'pedido_id' => $pedido->id,
        'producto_id' => $producto_id,
        'cantidad' => $attributes['cantidad'],
        'precio_unitario' => $attributes['precio_unitario']
        // Com pots veure, aquí no s'intenta inserir 'created_at'
    ]);
}
Log::info('Productes adjuntats manualment amb èxit.');                Log::info('Transacció completada amb èxit.');
            });

            // Si la transacció ha tingut èxit, $pedido contindrà el model.
            return $pedido; // ÈXIT: Retorna l'objecte Pedido

        } catch (\Illuminate\Database\QueryException $e) { // Captura errors SQL
            $errorMessage = 'Error de BBDD: ' . $e->getMessage();
            Log::error($errorMessage, ['sql' => $e->getSql() ?? 'N/A']);
            return $errorMessage; // FALLA: Retorna el missatge d'error

        } catch (\Exception $e) { // Captura altres errors (com "Producto no encontrado")
            $errorMessage = 'Error inesperat: ' . $e->getMessage();
            Log::error($errorMessage, ['trace' => $e->getTraceAsString()]);
            return $errorMessage; // FALLA: Retorna el missatge d'error
        }
    }


    /**
     * Muestra la página de agradecimiento.
     */
    public function thankyou(Pedido $pedido)
    {
        Log::info('Mostrant pàgina de "Gràcies".', ['pedido_id' => $pedido->id]);
        return view('public.thankyou', compact('pedido'));
    }
}

