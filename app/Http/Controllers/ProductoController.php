<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class ProductoController extends Controller
{
    /**
     * Muestra la lista de productos en el panel de administración.
     */
    public function index()
    {
        $productos = Producto::with('categoria')->latest()->get();

        return view('admin.productos.index', compact('productos'));
    }

    /**
     * Muestra el formulario para crear un nuevo producto.
     */
    public function create()
    {
        $categorias = Categoria::all();
        return view('admin.productos.create', compact('categorias'));
    }

    /**
     * Guarda un nuevo producto en la base de datos.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'precio' => 'required|numeric|min:0',
            'categoria_id' => 'nullable|exists:categorias,id',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'activo' => 'nullable|boolean',
            'destacado' => 'nullable|boolean',
        ]);

        $producto = new Producto();
        $producto->nombre = $request->nombre;
        $producto->descripcion = $request->descripcion;
        $producto->precio = $request->precio;
        $producto->categoria_id = $request->filled('categoria_id') ? $request->categoria_id : null;
        $producto->activo = $request->has('activo');
        $producto->destacado = $request->has('destacado');

        if ($request->hasFile('imagen')) {
            $path = $request->file('imagen')->store('productos', 'public');
            $producto->imagen = $path;
        }

        $producto->save();

        return redirect()->route('admin.productos.index')
                         ->with('success', 'Producto creado correctamente.');
    }

    /**
     * Muestra el formulario para editar un producto.
     */
    public function edit(Producto $producto)
    {
        $categorias = Categoria::all();
        return view('admin.productos.edit', compact('producto', 'categorias'));
    }

    /**
     * Actualiza un producto existente.
     */
    public function update(Request $request, Producto $producto)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'precio' => 'required|numeric|min:0',
            'categoria_id' => 'nullable|exists:categorias,id',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'activo' => 'nullable|boolean',
            'destacado' => 'nullable|boolean',
        ]);

        $validated['activo'] = $request->has('activo');
        $validated['destacado'] = $request->has('destacado');
        $validated['categoria_id'] = $request->filled('categoria_id') ? $request->categoria_id : null;

        if ($request->hasFile('imagen')) {
            if ($producto->imagen) {
                Storage::disk('public')->delete($producto->imagen);
            }
            $path = $request->file('imagen')->store('productos', 'public');
            $validated['imagen'] = $path;
        }

        $producto->update($validated);

        return redirect()->route('admin.productos.index')
                         ->with('success', 'Producto actualizado correctamente.');
    }

    /**
     * Elimina un producto.
     */
    public function destroy(Producto $producto)
    {
        if ($producto->imagen) {
            Storage::disk('public')->delete($producto->imagen);
        }

        $producto->delete();

        return redirect()->route('admin.productos.index')
                         ->with('success', 'Producto eliminado correctamente.');
    }

    /**
     * Toggle para campos booleanos: activo / destacado
     * Usado vía AJAX desde el frontend.
     */
    public function toggle(Request $request, Producto $producto, string $field): JsonResponse
    {
        if (!in_array($field, ['activo', 'destacado'])) {
            return response()->json([
                'success' => false,
                'message' => 'Campo no permitido.'
            ], 400);
        }

        $producto->update([$field => !$producto->$field]);

        return response()->json([
            'success' => true,
            'new_value' => $producto->$field,
            'message' => ucfirst($field) . ' actualizado.'
        ]);
    }

    /**
     * Establece un producto como "novedad" (solo uno a la vez).
     * Desactiva cualquier otro producto que tenga novedad = true.
     */
public function setNovedad(Producto $producto, Request $request): JsonResponse
{
    $value = $request->input('novedad', true); // Por defecto true

    try {
        DB::transaction(function () use ($producto, $value) {
            if ($value) {
                // Desactivar todas + activar esta
                Producto::where('novedad', true)->update(['novedad' => false]);
                $producto->update(['novedad' => true]);
            } else {
                // Solo desactivar esta
                $producto->update(['novedad' => false]);
            }
        });

        return response()->json([
            'success' => true,
            'message' => $value ? 'Novedad activada' : 'Novedad desactivada'
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Error al actualizar'
        ], 500);
    }
}
}