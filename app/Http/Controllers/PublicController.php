<?php // <--- Aquesta ha de ser la PRIMERA línia, sense res abans

namespace App\Http\Controllers; // <--- Aquesta ha de ser la SEGONA línia

use Illuminate\Http\Request;
use App\Models\Pagina;
use App\Models\Producto;
use App\Models\Categoria;
use Illuminate\Support\Facades\Log; 

class PublicController extends Controller
{
    /**
     * Muestra la página de inicio.
     */
// A app/Http/Controllers/PublicController.php

public function inicio()
{
    // Càrrega els productes marcats com a destacats (per a la secció superior)
    $productosDestacados = Producto::where('destacado', true)
                                   ->where('activo', true)
                                   ->latest()
                                   //->take(3)
                                   ->get();

    // CÀRREGA TOTS ELS PRODUCTES ACTIUS (per a la secció aleatòria)
    // Aquesta línia és IMPRESCINDIBLE perquè funcioni el botó "Sorprèn-me".
    $todosLosProductos = Producto::where('activo', true)->get();

    // Passa AMBDUES variables a la vista
    return view('public.inicio', [
        'productosDestacados' => $productosDestacados,
        'todosLosProductos'   => $todosLosProductos
    ]);
}
public function enviarContacto(Request $request)
{
    // Validar datos
    $request->validate([
        'nombre' => 'required|string|max:255',
        'email' => 'required|email',
        'mensaje' => 'required|string',
    ]);

    // Aquí puedes enviar un email, guardar en la BD, etc.
    // Por ejemplo, solo un mensaje de éxito en la sesión:
    return redirect()->route('public.contacto')->with('success', 'Mensaje enviado correctamente.');
}

public function contacto()
{
    return view('public.contacto');
}

    /**
     * Muestra el menú de productos por categorías.
     */
    public function menu()
    {
        try {
            $categoriasConProductos = Categoria::with([
                                            'productos' => function ($query) {
                                                $query->where('activo', true)->orderBy('nombre', 'asc');
                                            }
                                        ])
                                        ->whereHas('productos', function ($query) {
                                            $query->where('activo', true);
                                        })
                                        ->orderBy('nombre', 'asc') 
                                        ->get();

            return view('public.menu', compact('categoriasConProductos'));
        } catch (\Exception $e) {
            Log::error('Error inesperado en PublicController@menu: ' . $e->getMessage());
            abort(500, 'Error al cargar el menú.');
        }
    }

    /**
     * Muestra la página "Quiénes somos".
     */
    public function quienesSomos()
    {
         try {
            $pagina = Pagina::where('slug', 'quienes-somos')->firstOrFail(); 
            return view('public.quienes-somos', compact('pagina'));
         } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            Log::error('La página con slug "quienes-somos" no se encontró.');
            abort(404, 'Página no encontrada.');
         } catch (\Exception $e) {
            Log::error('Error inesperado en PublicController@quienesSomos: ' . $e->getMessage());
            abort(500, 'Error interno del servidor.');
         }
    }

    /**
     * Muestra el detalle de un producto.
     */
    public function showProducto(Producto $producto)
    {
        if (!$producto->activo) {
            abort(404, 'Aquest producte no està disponible.');
        }

        $producto->loadMissing('categoria');

        $relacionados = Producto::where('activo', true)
                                ->where('id', '!=', $producto->id);

        if ($producto->categoria_id) {
             $relacionados->where('categoria_id', $producto->categoria_id);
        } else {
             $relacionados->whereNull('categoria_id'); 
        }

        $relacionados = $relacionados->inRandomOrder()->take(3)->get();

        return view('public.producto-detalle', compact('producto', 'relacionados'));
    }
}