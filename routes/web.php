<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', function() { return view('about'); })->name('about');
Route::get('/contact', function() { return view('contact'); })->name('contact');
Route::get('/categories', [CategoryController::class, 'frontendIndex'])->name('categories.index');
Route::get('/products', [ProductController::class, 'productsPage'])->name('products.index');
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');
Route::get('/api/products/{product}/quick-view', [ProductController::class, 'quickView'])->name('products.quick-view');
Route::post('/products/{product}/inquiry', [ProductController::class, 'inquiry'])->name('products.inquiry');
Route::get('/products/{product}/whatsapp', [ProductController::class, 'whatsappInquiry'])->name('products.whatsapp');

Auth::routes();

// Profile routes
Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit')->middleware('auth');
Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update')->middleware('auth');

Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', function () {
        return view('admin.dashboard');
    })->name('dashboard')->middleware('permission:dashboard-access');
    
    // Categories routes with permissions
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index')->middleware('permission:category-list');
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create')->middleware('permission:category-create');
    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store')->middleware('permission:category-create');
    Route::get('/categories/{category}', [CategoryController::class, 'show'])->name('categories.show')->middleware('permission:category-list');
    Route::get('/categories/{category}/details', [CategoryController::class, 'details'])->name('categories.details')->middleware('permission:category-list');
    Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit')->middleware('permission:category-edit');
    Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update')->middleware('permission:category-edit');
    Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy')->middleware('permission:category-delete');
    Route::patch('/categories/{category}/toggle-status', [CategoryController::class, 'toggleStatus'])->name('categories.toggle-status')->middleware('permission:category-edit');
    
    // Products routes with permissions
    Route::get('/products', [AdminProductController::class, 'index'])->name('products.index')->middleware('permission:product-list');
    Route::get('/products/create', [AdminProductController::class, 'create'])->name('products.create')->middleware('permission:product-create');
    Route::post('/products', [AdminProductController::class, 'store'])->name('products.store')->middleware('permission:product-create');
    Route::get('/products/{product}', [AdminProductController::class, 'show'])->name('products.show')->middleware('permission:product-list');
    Route::get('/products/{product}/details', [AdminProductController::class, 'details'])->name('products.details')->middleware('permission:product-list');
    Route::get('/products/{product}/edit', [AdminProductController::class, 'edit'])->name('products.edit')->middleware('permission:product-edit');
    Route::put('/products/{product}', [AdminProductController::class, 'update'])->name('products.update')->middleware('permission:product-edit');
    Route::delete('/products/{product}', [AdminProductController::class, 'destroy'])->name('products.destroy')->middleware('permission:product-delete');
    
    // Product image management routes
    Route::post('/products/{product}/toggle-stock', [AdminProductController::class, 'toggleStock'])->name('products.toggle-stock')->middleware('permission:product-edit');
    Route::delete('/products/{product}/images/{imageId}/remove', [AdminProductController::class, 'removeImage'])->name('products.images.remove')->middleware('permission:product-edit');
    Route::post('/products/{product}/images/{imageId}/set-primary', [AdminProductController::class, 'setPrimaryImage'])->name('products.images.set-primary')->middleware('permission:product-edit');
    
    // Orders routes with permissions
    Route::get('/orders', [AdminOrderController::class, 'index'])->name('orders.index')->middleware('permission:order-list');
    Route::get('/orders/create', [AdminOrderController::class, 'create'])->name('orders.create')->middleware('permission:order-create');
    Route::post('/orders', [AdminOrderController::class, 'store'])->name('orders.store')->middleware('permission:order-create');
    Route::get('/orders/{order}', [AdminOrderController::class, 'show'])->name('orders.show')->middleware('permission:order-list');
    Route::get('/orders/{order}/details', [AdminOrderController::class, 'details'])->name('orders.details')->middleware('permission:order-list');
    Route::get('/orders/{order}/edit', [AdminOrderController::class, 'edit'])->name('orders.edit')->middleware('permission:order-edit');
    Route::put('/orders/{order}', [AdminOrderController::class, 'update'])->name('orders.update')->middleware('permission:order-edit');
    Route::delete('/orders/{order}', [AdminOrderController::class, 'destroy'])->name('orders.destroy')->middleware('permission:order-delete');
    Route::patch('/orders/{order}/status', [AdminOrderController::class, 'updateStatus'])->name('orders.updateStatus')->middleware('permission:order-edit');
    
    // Users routes with permissions (only Super Admin can manage users)
    Route::get('/users', [UserController::class, 'index'])->name('users.index')->middleware('permission:user-list');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit')->middleware('permission:user-edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update')->middleware('permission:user-edit');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy')->middleware('permission:user-delete');
    
    // Roles routes with permissions (only Super Admin can manage roles)
    Route::get('/roles', [RoleController::class, 'index'])->name('roles.index')->middleware('permission:role-list');
    Route::get('/roles/create', [RoleController::class, 'create'])->name('roles.create')->middleware('permission:role-create');
    Route::post('/roles', [RoleController::class, 'store'])->name('roles.store')->middleware('permission:role-create');
    Route::get('/roles/{role}/edit', [RoleController::class, 'edit'])->name('roles.edit')->middleware('permission:role-edit');
    Route::put('/roles/{role}', [RoleController::class, 'update'])->name('roles.update')->middleware('permission:role-edit');
    Route::delete('/roles/{role}', [RoleController::class, 'destroy'])->name('roles.destroy')->middleware('permission:role-delete');
    
    // Permissions routes with permissions (only Super Admin can manage permissions)
    Route::get('/permissions', [PermissionController::class, 'index'])->name('permissions.index')->middleware('permission:permission-list');
    Route::get('/permissions/create', [PermissionController::class, 'create'])->name('permissions.create')->middleware('permission:permission-create');
    Route::post('/permissions', [PermissionController::class, 'store'])->name('permissions.store')->middleware('permission:permission-create');
    Route::get('/permissions/{permission}/edit', [PermissionController::class, 'edit'])->name('permissions.edit')->middleware('permission:permission-edit');
    Route::put('/permissions/{permission}', [PermissionController::class, 'update'])->name('permissions.update')->middleware('permission:permission-edit');
    Route::delete('/permissions/{permission}', [PermissionController::class, 'destroy'])->name('permissions.destroy')->middleware('permission:permission-delete');
});
