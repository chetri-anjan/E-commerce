<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\OrderController;
use App\Models\Product;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\RatingController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    $products = Product::all();
    return view('home', ['products' => $products]);
});
// Route::get('/home', function () {
//     return view('home');
// })->name('home');

Route::get('/home', function () {
    $products = Product::all();
    return view('home', ['products' => $products]);
})->name('home');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/userpanel', [ProfileController::class, 'showProfile'])
->middleware(['auth', 'verified'])->name('userpanel');

Route::get('/adminpanel', [ProfileController::class, 'showAllUsers'])
->middleware(['auth', 'verified'])->name('adminpanel');


// Route::get('/adminpanel', function () {
//     return view('adminpanel');
// })->middleware(['auth', 'verified'])->name('adminpanel');

Route::get('/admin/order/{id}/edit', [PurchaseController::class, 'edit'])->middleware(['auth', 'verified'])->name('editOrder');
Route::post('/admin/order/update', [PurchaseController::class, 'update'])->middleware(['auth', 'verified'])->name('updateOrder');





Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //ADD product form
    Route::get('/add_product', [ProductController::class, 'add_product_form'])->name('add_products');
    Route::post('/add_product', [ProductController::class, 'create_product'])->name('add_products');

    //address form route
    Route::get('/add_address', [PurchaseController::class, 'add_address_form'])->name('add_addresses');
    Route::post('/add_address', [PurchaseController::class, 'create_address_form'])->name('add_addresses');

    //cart routes
    Route::get('/cart', [PurchaseController::class, 'index'])->name('cart.index');
    Route::post('/cart/add', [PurchaseController::class, 'add'])->name('cart.add');  

    //delete item from cart
    Route::delete('/cart/{id}', [PurchaseController::class, 'delete'])->name('cart.delete');


    //buy now route
    Route::get('/buynow/{id}', [PurchaseController::class, 'productbuy'])->name('buyproduct');

    Route::delete('/purchases/{id}', [PurchaseController::class, 'destroy'])->name('purchases.destroy');

    

    //payment System using Stripe 
    Route::get('/product/{id}', [PurchaseController::class, 'showProduct'])->name('show.product');
    Route::post('/checkout/{id}', [PurchaseController::class, 'checkout'])->name('checkout');
    // success full payment
    Route::get('payment-success/{purchase}', [PurchaseController::class, 'paymentSuccess'])->name('payment.success');
    //mail working route
    Route::get('send-mail', [EmailController::class, 'sendWelcomeEmail']);



    //review route
    Route::post('/product/{id}/rating', [RatingController::class, 'store'])->name('ratings.store');

    //order route
    Route::get('orders', [PurchaseController::class, 'showallorders'])->name('show.orders');


    //userpanel ko users show route
    Route::get('/admin/users', [ProfileController::class, 'showAllUsers'])->name('admin.users');

    //billing route
    Route::get('/billing/{id}', [PurchaseController::class, 'showBillingDetails'])->name('billing');



});


//singleproduct show route
Route::get('/product/{id}', [ProductController::class, 'single_product'])->name('show_product');

//product shows
Route::get('/products', [ProductController::class, 'showProducts'])->name('products');

Route::get('/contact', function () {
    return view('contactus');
})->name('contact');

Route::get('/aboutus', function () {
    return view('aboutus');
})->name('about');








require __DIR__.'/auth.php';
