<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use Illuminate\Http\Request;

class PedidoController extends Controller
{
    /**
     * Muestra la lista de pedidos con opciones de filtro y búsqueda.
     */
    public function index(Request $request)
    {
        // 1. Inicia la consulta
        $pedidos = Pedido::orderBy('created_at', 'desc');

        // 2. FILTRO POR ESTADO
        if ($request->has('estado') && $request->input('estado') != '') {
            $pedidos->where('estado', $request->input('estado'));
        }

        // 3. BUSCADOR POR CLAVE (ID, nombre, teléfono)
        if ($request->has('search') && $request->input('search') != '') {
            $search = $request->input('search');
            $pedidos->where(function ($query) use ($search) {
                // Convertimos el ID a texto para poder usar LIKE (útil en SQLite y Postgres)
                $query->whereRaw('CAST(id as TEXT) LIKE ?', ["%{$search}%"])
                      ->orWhere('cliente_nombre', 'like', "%{$search}%")
                      ->orWhere('cliente_telefono', 'like', "%{$search}%");
            });
        }

        // 4. Ejecuta la consulta y aplica paginación
        // withQueryString() mantiene los filtros (estado, search) en los enlaces de paginación
        $pedidosPaginados = $pedidos->paginate(15)->withQueryString();

        // 5. Contadores globales
        $totalPedidos = Pedido::count();
        $pendientes   = Pedido::where('estado', 'Pendiente')->count();
        $listos       = Pedido::where('estado', 'Listo')->count();

        return view('admin.pedidos.index', compact('pedidosPaginados', 'totalPedidos', 'pendientes', 'listos'));
    }

    /**
     * Maneja las acciones masivas (Actualizar estado o Eliminar)
     * CORREGIDO PARA DEVOLVER LA RESPUESTA JSON COMPLETA
     */
    public function bulkAction(Request $request)
    {
        $action = $request->input('action');
        $selectedPedidos = $request->input('selected_pedidos', []);

        if (empty($selectedPedidos)) {
            // El JS espera JSON, así que devolvemos un error JSON
            return response()->json([
                'success' => false,
                'message' => 'No s\'han seleccionat comandes.'
            ], 400);
        }

        $message = '';
        $updatedPedidos = []; // Para guardar los pedidos actualizados

        if ($action === 'update_status') {
            $estado = $request->input('bulk_estado');
            if (!$estado) {
                return response()->json([
                    'success' => false,
                    'message' => 'Selecciona un estat per actualitzar.'
                ], 400);
            }
            
            // Actualizamos la base de datos
            Pedido::whereIn('id', $selectedPedidos)->update(['estado' => $estado]);
            
            // Obtenemos los datos actualizados que el JS necesita
            $updatedPedidos = Pedido::whereIn('id', $selectedPedidos)->get(['id', 'estado']);
            
            $message = 'Estat actualitzat correctament.';

        } elseif ($action === 'delete') {
            Pedido::whereIn('id', $selectedPedidos)->delete();
            $message = 'Comandes eliminades correctament.';
        
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Acció no vàlida.'
            ], 400);
        }

        // --- BUG CORREGIDO ---
        // Recalculamos los contadores (con 'Pendiente' en mayúscula)
        $counters = [
            'pendientes' => Pedido::where('estado', 'Pendiente')->count(), // <-- CORREGIDO
            'listos' => Pedido::where('estado', 'Listo')->count(),
            'totalPedidos' => Pedido::count(),
        ];

        // --- BUG PRINCIPAL CORREGIDO ---
        // Devolvemos la respuesta JSON completa que el JavaScript espera
        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,                  // <-- AÑADIDO: El JS lo necesita
                'message' => $message,
                'counters' => $counters,
                'updated_pedidos' => $updatedPedidos // <-- AÑADIDO: El JS lo necesita
            ]);
        }

        // Fallback por si la llamada no fue AJAX (como el botón de eliminar original)
        return redirect()->route('admin.pedidos.index')
                        ->with('success', $message)
                        ->with('counters', $counters); // Pasa contadores por sesión
    }
    
    /**
     * Muestra los detalles de un pedido específico.
     */
    public function show(Pedido $pedido)
    {
        // Cargamos la relación de productos para mostrar el detalle
        $pedido->load('productos'); 
        
        return view('admin.pedidos.show', compact('pedido'));
    }

    /**
     * Actualiza el estado de un pedido (Ej: de 'Pendiente' a 'Completado').
     * Este método es para la VISTA DE DETALLE (show.blade.php)
     */
    public function update(Request $request, Pedido $pedido)
    {
        $request->validate([
            // Añadidos más estados para coincidir con la vista
            'estado' => 'required|string|in:Pendiente,En Proceso,Listo,Recogido,Cancelado,Pagado', 
        ]);

        $pedido->estado = $request->estado;
        $pedido->save();

        // Redirigimos de vuelta al detalle del pedido con mensaje de éxito
        return redirect()->route('admin.pedidos.show', $pedido)->with('success', 'Estado del pedido actualizado.');
    }

    /**
     * Elimina un pedido.
     */
    public function destroy(Pedido $pedido)
    {
        // La tabla pivote (pedido_producto) se borrará en cascada si está bien configurada
        $pedido->delete();

        return redirect()->route('admin.pedidos.index')->with('success', 'Pedido eliminado correctamente.');
    }

    // --- Métodos no necesarios para el admin (buena práctica dejarlos así) ---
    public function create() { abort(404); }
    public function store(Request $request) { abort(404); }
    public function edit(Pedido $pedido) { abort(404); }
}
