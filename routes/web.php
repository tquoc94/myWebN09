<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AdminController;



// Site public
Route::get('/', [ProductController::class,'index'])->name('home');
Route::get('/product/{slug}', [ProductController::class,'show'])->name('product.show');
// Route::get('/categories', [CategoryController::class,'index'])->name('categories.index');
Route::get('/trai-cay-nhap-khau', [ProductController::class, 'importedFruits'])->name('importedFruits');
Route::get('/trai-cay-viet-nam', [ProductController::class, 'localFruits'])->name('localFruits');

// trang khuyen mai
Route::get('/khuyen-mai', [ProductController::class, 'promotion'])->name('products.promotion');

// tim kiem
Route::get('/search', [ProductController::class, 'search'])->name('products.search');

Route::get('/welcome', function () {
    return view('welcome');  // Đây là view mặc định trong Laravel
})->name('welcome');

Route::get('/dashboard', function () {
    return view('dashboard'); // hoặc view bất kỳ bạn muốn redirect đến
})->middleware(['auth'])->name('dashboard');

// Auth cần user login
Route::middleware('auth')->group(function(){

  Route::post('/cart/add',[CartController::class,'add'])->name('cart.add');
  Route::get('/cart',      [CartController::class,'index'])->name('cart.index');
  Route::post('/cart/update',[CartController::class,'update'])->name('cart.update');
  Route::post('/cart/remove/{id}',[CartController::class,'remove'])->name('cart.remove');

  Route::get('/checkout',  [OrderController::class,'create'])->name('order.create');
  Route::post('/checkout', [OrderController::class,'store'])->name('order.store');
  Route::get('/orders',    [OrderController::class,'index'])->name('order.index');
});

// auth cho admin
Route::middleware('auth', 'admin')->group(function (){ 
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.products.index');
    
    // Route tạo sản phẩm
    Route::get('/admin/products/create', [ProductController::class, 'create'])->name('admin.products.create');
    Route::post('/admin/products', [ProductController::class, 'store'])->name('admin.products.store');
    
    // Route chỉnh sửa sản phẩm
    Route::get('/admin/products/{id}/edit', [ProductController::class, 'edit'])->name('admin.products.edit');
    Route::put('/admin/products/{id}', [ProductController::class, 'update'])->name('admin.products.update');
    
    // Route xóa sản phẩm
    Route::delete('/admin/products/{id}', [ProductController::class, 'destroy'])->name('admin.products.destroy');
    // xem danh sach don hang
    Route::get('/admin/orders', [OrderController::class, 'adminIndex'])->name('admin.orders.index');
    // xem chi tiet don hang
    Route::get('/admin/orders/{id}', [OrderController::class, 'adminShow'])->name('admin.orders.show');

    // Da giao hang
    Route::patch('/admin/orders/{id}/status', [OrderController::class, 'updateStatus'])->name('admin.orders.updateStatus');

    // Route xem chi tiết sản phẩm
    Route::get('/admin/products/{slug}', [ProductController::class, 'show'])->name('admin.products.show');
}); 



require __DIR__.'/auth.php';
