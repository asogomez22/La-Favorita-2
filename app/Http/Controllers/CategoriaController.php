<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    /**
     * Muestra la lista de categorías.
     */
    public function index()
    {
        $categorias = Categoria::all();
        return view('admin.categorias.index', compact('categorias'));
    }

    /**
     * Muestra el formulario para crear una nueva categoría.
     */
    public function create()
    {
        return view('admin.categorias.create');
    }

    /**
     * Guarda una nueva categoría en la base de datos.
     */
    public function store(Request $request)
    {
        // Se ha eliminado la validación del precio
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255',
        ]);

        Categoria::create($validatedData);

        return redirect()->route('admin.categorias.index')->with('success', 'Categoría creada correctamente.');
    }

    /**
     * Muestra una categoría específica (no la usamos mucho en admin).
     */
    public function show(Categoria $categoria)
    {
        return view('admin.categorias.edit', compact('categoria'));
    }

    /**
     * Muestra el formulario para editar una categoría.
     */
    public function edit(Categoria $categoria)
    {
        return view('admin.categorias.edit', compact('categoria'));
    }

    /**
     * Actualiza una categoría existente.
     */
    public function update(Request $request, Categoria $categoria)
    {
        // Se ha eliminado la validación del precio
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255',
        ]);

        $categoria->update($validatedData);

        return redirect()->route('admin.categorias.index')->with('success', 'Categoría actualizada correctamente.');
    }

    /**
     * Elimina una categoría (¡CON VALIDACIÓN!).
     */
    public function destroy(Categoria $categoria)
    {
        // ¡NUEVA LÓGICA DE VALIDACIÓN!
        // Contamos cuántos productos tiene esta categoría
        if ($categoria->productos()->count() > 0) {
            // Si tiene 1 o más, redirigimos hacia atrás con un mensaje de error
            return redirect()->route('admin.categorias.index')
                             ->with('error', 'No se puede eliminar esta categoría porque tiene productos asociados.');
        }

        // Si no tiene productos, la eliminamos de forma segura
        $categoria->delete();
        
        return redirect()->route('admin.categorias.index')
                         ->with('success', 'Categoría eliminada correctamente.');
    }
}

