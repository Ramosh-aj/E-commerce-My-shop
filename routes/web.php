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

// Route::get('/', function () {
//     return view('welcome');
// });

//frontendcontroller

Route::controller(App\Http\Controllers\Frontend\FrontendController::class)->group(function(){
    Route::get('/', 'index');
    Route::get('/collections', 'categories');
    Route::get('/collections/{category_slug}', 'products');
    //49
    Route::get('/collections/{category_slug}/{product_slug}', 'productView');
    Route::get('/new-arrivals', 'newArrival');
    //51
    Route::get('/featured-products', 'featuredProducts');
    //57
    Route::get('search', 'searchProducts');

});

//wishlistcontroller

Route::middleware(['auth'])->group(function(){
    Route::get('/wishlist', [App\Http\Controllers\Frontend\WishListController::class, 'index']);
    Route::get('/cart', [App\Http\Controllers\Frontend\CartController::class, 'index']);
    Route::get('/checkout', [App\Http\Controllers\Frontend\CheckoutController::class, 'index']);
    // 42
    Route::get('/orders', [App\Http\Controllers\Frontend\OrderController::class, 'index']);
    //view button
    //43
    Route::get('/orders/{orderId}', [App\Http\Controllers\Frontend\OrderController::class, 'show']);
    //58
    Route::get('/profile', [App\Http\Controllers\Frontend\UserController::class, 'index']);
    Route::post('/profile', [App\Http\Controllers\Frontend\UserController::class, 'updateUserDetail']);
    // 59 -->
    Route::get('/changePassword', [App\Http\Controllers\Frontend\UserController::class, 'passwordCreate']);
    Route::post('/changePassword', [App\Http\Controllers\Frontend\UserController::class, 'changePassword']);


});
//39
Route::get('thank-you', [App\Http\Controllers\Frontend\FrontendController::class, 'thankyou']);


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('admin')->middleware(['auth','isAdmin'])->group(function(){

    Route::get('dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index']);
    //setting 53
    Route::get('settings', [App\Http\Controllers\Admin\SettingController::class, 'index']);
    Route::post('settings', [App\Http\Controllers\Admin\SettingController::class, 'store']);

    Route::controller(App\Http\Controllers\Admin\SliderController::class)->group(function(){
        Route::get('/sliders', 'index');
        Route::get('/sliders/create', 'create');
        Route::post('/sliders/create', 'store');
        Route::get('sliders/{slider}/edit', 'edit');
        Route::put('sliders/{slider}', 'update');
        Route::get('sliders/{slider}/delete', 'destroy');


    });
    //category Rote:
    // Route::get('category', [App\Http\Controllers\Admin\CategoryController::class, '']);

    // Route::get(, [App\Http\Controllers\Admin\CategoryController::class, 'create']);

    // Route::post('category', [App\Http\Controllers\Admin\CategoryController::class, 'store']);

    //category Rote:
    Route::controller(App\Http\Controllers\Admin\CategoryController::class)->group(function(){
        Route::get('/category', 'index');
        Route::get('/category/create', 'create');
        Route::post('category','store');
        Route::get('/category/{category}/edit', 'edit');
        Route::put('/category/{category}', 'update');


    });
    //product Rote
    Route::controller(App\Http\Controllers\Admin\ProductController::class)->group(function(){
        Route::get('/products', 'index');
        Route::get('/products/create', 'create');
        Route::post('products','store');
        Route::get('products/{product}/edit','edit');
        Route::put('/products/{product}', 'update');
        Route::get('products/{product_id}/delete', 'destroy');
        Route::get('product-image/{product_image_id}/delete', 'destroyImage');
        Route::post('product-color/{prod_color_id}','updateProdColorQty');
        Route::get('product-color/{prod_color_id}/delete','deleteProdColor');

    });

        //product Rote
        Route::controller(App\Http\Controllers\Admin\ColorController::class)->group(function(){
            Route::get('/colors', 'index');
            Route::get('/colors/create', 'create');
            Route::post('/colors/create','store');
            Route::get('/color/{color}/edit','edit');
            Route::put('/colors/{color_id}','update');
            Route::get('/color/{color_id}/delete','destroy');


        });


    Route::get('/brands', 'App\Http\Livewire\Admin\Brand\index'::class);


            //Admin Order Rote
            Route::controller(App\Http\Controllers\Admin\OrderController::class)->group(function(){
                Route::get('/orders', 'index');
                Route::get('/orders/{orderId}', 'show');
                //46
                Route::put('/orders/{orderId}', 'updateOrderStatus');
                //47
                Route::get('/invoice/{orderId}', 'viewInvoice');
                Route::get('/invoice/{orderId}/generate', 'generateInvoice');

                //60
                Route::get('/invoice/{orderId}/mail', 'mailInvoice');

            });



            Route::controller(App\Http\Controllers\Admin\UserController::class)->group(function(){
                Route::get('/users', 'index');
                Route::get('/users/create', 'create');
                Route::post('/users', 'store');
                Route::get('/users/{user_id}/edit', 'edit');
                Route::put('/users/{user_id}', 'update');
                Route::get('/users/{user_id}/delete', 'destroy');

                //Route::get('/users/{user_id}/create', 'delete');

            });

});

