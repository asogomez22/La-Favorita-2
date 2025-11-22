<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\CartController;
use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Pedido;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// ----------------------------------------------------------------------
// RUTAS PÚBLICAS (Acceso público)
// ----------------------------------------------------------------------
Route::get('/', [PublicController::class, 'inicio'])->name('public.inicio');
Route::get('/quienes-somos', [PublicController::class, 'quienesSomos'])->name('public.quienes-somos');
Route::get('/menu', [PublicController::class, 'menu'])->name('public.menu');
Route::get('/contacto', [PublicController::class, 'contacto'])->name('public.contacto');
Route::post('/contacto/enviar', [PublicController::class, 'enviarContacto'])->name('contacto.enviar');

// Detalle de producto
Route::get('/producto/{producto}', [PublicController::class, 'showProducto'])->name('producto.detalle');

// ----------------------------------------------------------------------
// CARRITO Y CHECKOUT
// ----------------------------------------------------------------------
Route::prefix('cart')->name('cart.')->group(function () {
    Route::get('/', [CartController::class, 'index'])->name('index');
    Route::post('/add/{producto}', [CartController::class, 'add'])->name('add');
    Route::post('/update/{producto}', [CartController::class, 'update'])->name('update');
    Route::post('/remove/{producto}', [CartController::class, 'remove'])->name('remove');
    Route::post('/clear', [CartController::class, 'clear'])->name('clear');

    Route::get('/checkout', [CartController::class, 'checkout'])->name('checkout');
    Route::post('/start-checkout', [CartController::class, 'startCheckout'])->name('startCheckout');

    Route::get('/payment/success', [CartController::class, 'paymentSuccess'])->name('payment.success');
    Route::get('/payment/cancel', [CartController::class, 'paymentCancel'])->name('payment.cancel');

    Route::get('/thankyou/{pedido}', [CartController::class, 'thankyou'])->name('thankyou');
});

// ----------------------------------------------------------------------
// DASHBOARD (Usuario autenticado)
// ----------------------------------------------------------------------
// ----------------------------------------------------------------------
// PERFIL DE USUARIO
// ----------------------------------------------------------------------
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ----------------------------------------------------------------------
// PANEL DE ADMINISTRACIÓN (Solo admin)
// ----------------------------------------------------------------------
Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {

    // Dashboard
    Route::get('/dashboard', function () {
        $productCount = Producto::count();
        $categoryCount = Categoria::count();
        $orderCount = Pedido::count();
    
        return view('admin.dashboard', compact('productCount', 'categoryCount', 'orderCount'));
    })->name('dashboard');

    // Recursos CRUD
    Route::resource('productos', ProductoController::class);
    Route::resource('categorias', CategoriaController::class);
    Route::resource('pedidos', PedidoController::class);

    // AJAX: Toggle activo / destacado
    Route::patch(
        'productos/{producto}/toggle/{field}',
        [ProductoController::class, 'toggle']
    )->where('field', 'activo|destacado')
      ->name('productos.toggle');

    // AJAX: Establecer novedad (solo uno)
    Route::patch(
        'productos/{producto}/set-novedad',
        [ProductoController::class, 'setNovedad']
    )->name('productos.set-novedad');

    // Pedidos: Acción en lote
    Route::post('/pedidos/bulk-action', [PedidoController::class, 'bulkAction'])
         ->name('pedidos.bulk-action');
});

// ----------------------------------------------------------------------
// AUTENTICACIÓN (Laravel Breeze / Jetstream)
// ----------------------------------------------------------------------
require __DIR__.'/auth.php';