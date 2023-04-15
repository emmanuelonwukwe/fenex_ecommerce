<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('index')
    ->with('categories', app(App\Http\Controllers\CategoryController::class)->index())
    ->with('products', App\Http\Controllers\ProductController::index())
    ->with('carts', (new App\Http\Controllers\CartController)->index());

})->name('index');

Route::get('/admin/register', function(){
    return view('auth.admin-register');
})->name('admin.register');


Auth::routes();

//admin middleware group for admin pages
Route::group(["middleware" => array("auth", "admin"), "prefix" => "admin"], function(){
    Route::get("/dashboard", [App\Http\Controllers\Admin\AdminController::class, "dashboardView"])->name("admin.dashboard");

    Route::get("/create/category", [App\Http\Controllers\CategoryController::class, "adminCreateCategoryView"])->name("admin.create.category");
    Route::get("/view/categories/{update_category_id?}", [App\Http\Controllers\CategoryController::class, "adminViewCategoriesView"])->name("admin.view.categories");
    Route::delete("/delete/category", [App\Http\Controllers\CategoryController::class, "destroy"])->name("admin.delete.category");
    Route::post("/formcreate/category", [App\Http\Controllers\CategoryController::class, "adminCreateCategory"])->name("admin.formcreate.category");

    Route::get("/create/product", [App\Http\Controllers\ProductController::class, "adminCreateProductView"])->name("admin.create.product");
    Route::get("/view/products/{update_product_id?}", [App\Http\Controllers\ProductController::class, "adminViewProductsView"])->name("admin.view.products");
    Route::delete("/delete/products", [App\Http\Controllers\ProductController::class, "destroy"])->name("admin.delete.product");
    Route::post("/formcreate/product", [App\Http\Controllers\ProductController::class, "adminCreateProduct"])->name("admin.formcreate.product");

    Route::get("/view/users/cart", [App\Http\Controllers\CartController::class, "adminViewUsersCartView"])->name("admin.view.users.cart");

});

//users office
Route::middleware("auth")->middleware("user")->prefix("account")->group(function(){
    Route::get('/dashboard', [App\Http\Controllers\UserController::class, 'dashboardView'])->name('account.dashboard');
    Route::get('/cart', [App\Http\Controllers\CartController::class, 'cartView'])->name('account.cart');

});

Route::middleware("auth")->group(function (){
    Route::delete("/cart", [App\Http\Controllers\CartController::class, 'delete'])->name("cart.delete");
    Route::post("/cart/add/product/{product_id}", [App\Http\Controllers\CartController::class, 'store'])->name("cart.add.product");
});
