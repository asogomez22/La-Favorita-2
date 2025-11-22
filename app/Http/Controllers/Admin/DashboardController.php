<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Producto;
use App\Models\Categoria;

class DashboardController extends Controller
{
    public function index()
    {
        // Contar productos y categorías
        $productCount = Producto::count();
        $categoryCount = Categoria::count();

        // Enviar a la vista
        return view('admin.dashboard', compact('productCount', 'categoryCount'));
    }
}
