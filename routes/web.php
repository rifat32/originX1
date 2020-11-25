<?php

use App\Http\Controllers\AdminMessagesController;
use App\Http\Controllers\AdminOrderController;
use App\Http\Controllers\AdminSide;
use App\Http\Controllers\CheckOutController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\OrdarThis;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductController2;
use App\Http\Controllers\ProductController3;
use App\Http\Controllers\ProductController4;
use App\Http\Controllers\ProductController5;
use App\Http\Controllers\ProductVisibleController;
use App\Http\Controllers\ProductVisibleController2;
use App\Http\Controllers\ShoppingCartController;
use App\Http\Controllers\SimplePagesController;

use App\Http\Controllers\WelcomePageController;
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

Route::get('/', [WelcomePageController::class, 'welcome']);

// search @@@@@@@@@@@@@@@@@@@@@@@

Route::post('/search', [SimplePagesController::class, "Search"])->name('search');

// products @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@

Route::get('/products/{serviceType}/{serviceCategory}', [ProductVisibleController::class, "ProductsView"]);

// Single Product @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
Route::get('/product/{id}',[ProductVisibleController2::class, "singleProduct"])
;


// Comment @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
Route::get('/showComments/{id}',[CommentController::class, "showComents"])
;

Route::post('/comment',[CommentController::class, "postComment"]);





// Contact @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
Route::get('/contact', [SimplePagesController::class, 'contact']);
Route::post('/contact', [SimplePagesController::class, 'contactMessage'])->name('contact.message');


Route::get('/faq',  [SimplePagesController::class, 'faq']);

// checkout @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
Route::middleware(['auth:sanctum', 'verified'])->get('/check-out', [CheckOutController::class, 'checkOut']);

Route::post('/placeOrder', [CheckOutController::class, 'placeOrder'])->name('place.order');

Route::middleware(['auth:sanctum', 'verified'])->get('/order-this-auth', [OrdarThis::class, 'orderThisAuth']);

Route::post('/placeOrderThisAuth', [OrdarThis::class, 'placeOrderThisAuth'])->name('place.order.Auth');

Route::get('/order-this-guest', [OrdarThis::class, 'orderThisGuest']);

Route::post('/placeOrderThisGuest', [OrdarThis::class, 'placeOrderThisGuest'])->name('place.order.Guest');

Route::middleware(['auth:sanctum', 'verified'])->get('/active-orders', [SimplePagesController::class, 'activeOrders']);





Route::get('/main', function () {
    return view('main');
});


Route::middleware(['auth:sanctum', 'verified'])->get('/shopping-cart', [ShoppingCartController::class, 'shoppingCart']);
Route::get('/cartAjaxDataAll', [ShoppingCartController::class, 'cartAjaxDataAll']);
Route::post('/cartAjaxDataDelete/{id}', [ShoppingCartController::class, 'cartAjaxDataDelete']);

Route::get('/cartAjaxTotalPriceAll', [ShoppingCartController::class, 'cartAjaxTotalPriceAll']);


Route::post('/add-to-cart', [ShoppingCartController::class, 'addCart'])->name('addCart');
// Admin Panel ###############################################
Route::middleware(['auth:sanctum', 'verified'])->get('/home', [WelcomePageController::class, 'welcome'])->name('home');

// Admin Side @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
Route::get('/admin-login', [AdminSide::class , 'index']);
Route::post('/admin-login', [AdminSide::class , 'adminCheck'])->name('admin.validate');
Route::get('/admin-panel', [AdminSide::class , 'adminPanelValidate']);
Route::post('/admin-logout', [AdminSide::class , 'adminLogout'])->name('admin.logout');

// Add Product @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
Route::get('/admin-panel/add-product/{serviceType}', [ProductController::class , 'addProduct']);
Route::post('/admin-panel/add-product', [ProductController::class , 'storeProduct'])->name('product.store');
// View Product @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
Route::get('/admin-panel/view-products/{serviceType}', [ProductController2::class , 'viewProducts']);
Route::get('/admin-panel/all-products', [ProductController2::class , 'allProducts']);

// Edit Product @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
Route::get('/admin-panel/edit-product/{id}', [ProductController2::class , 'editProduct']);
Route::post('/admin-panel/update-product', [ProductController2::class , 'updateProduct'])->name('product.update');
// Delete Product @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
Route::get('/admin-panel/delete-product/{id}', [ProductController2::class , 'deleteProduct']);

// Add Service
Route::get('/admin-panel/add-service', [ProductController::class , 'addService']);
Route::post('/admin-panel/add-service', [ProductController::class , 'storeService'])->name('service.store');
// View Services
Route::get('/admin-panel/admin-view-services', [ProductController3::class , 'viewServices']);
// Edit Service @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
Route::get('/admin-panel/edit-service/{id}', [ProductController3::class , 'editService']);
Route::post('/admin-panel/update-service', [ProductController3::class , 'updateService'])->name('service.update');
// Delete Service @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
Route::get('/admin-panel/delete-service/{id}', [ProductController3::class , 'deleteService']);


// Add Cagegory
Route::get('/admin-panel/add-product-category', [ProductController::class , 'addProductCategory']);
Route::post('/admin-panel/add-product-category', [ProductController::class , 'storeProductCategory'])->name('productCategory.store');
// View Categories
Route::get('/admin-panel/admin-view-categories/{serviceType}', [ProductController4::class , 'viewCategories']);
// Edit Category @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
Route::get('/admin-panel/edit-category/{id}', [ProductController4::class , 'editCategory']);
Route::post('/admin-panel/update-category', [ProductController4::class , 'updateCategory'])->name('productCategory.update');
// Delete Category @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
Route::get('/admin-panel/delete-category/{id}', [ProductController4::class , 'deleteCategory']);


// Add Global Tags
Route::get('/admin-panel/add-global-tags', [ProductController::class , 'addGlobalTags']);
Route::post('/admin-panel/add-global-tags', [ProductController::class , 'storeGlobalTag'])->name('globalTag.store');
// View Global Tags
Route::get('/admin-panel/admin-view-tags/{serviceType}', [ProductController5::class , 'viewTags']);
// Edit Global Tags @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
Route::get('/admin-panel/edit-tag/{id}', [ProductController5::class , 'editTag']);
Route::post('/admin-panel/update-tag', [ProductController5::class , 'updateTag'])->name('globalTag.update');
// Delete Global Tags @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
Route::get('/admin-panel/delete-tag/{id}', [ProductController5::class , 'deleteTag']);

// Active Orders
Route::get('/admin-panel/active-orders', [AdminOrderController::class , 'viewActiveOrders']);
// View Order
Route::get('/admin-panel/view-order/{id}', [AdminOrderController::class , 'viewOrder']);
// Delete Cart
Route::get('/admin-panel/delete-cart-admin/{id}', [AdminOrderController::class , 'deleteCart']);
// Complete Order
Route::get('/admin-panel/complete-order/{id}', [AdminOrderController::class , 'completeOrder']);
// Cancel Order
Route::get('/admin-panel/cancel-order/{id}', [AdminOrderController::class , 'cancelOrder']);
// Completed Orders
Route::get('/admin-panel/completed-orders', [AdminOrderController::class , 'viewCompletedOrders']);
// View Messages
Route::get('/admin-panel/messages', [AdminMessagesController::class , 'viewMessages']);
// Delete Messages
Route::get('/admin-panel/delete-message/{id}', [AdminMessagesController::class , 'deleteMessage']);



