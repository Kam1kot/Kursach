<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\MainController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Route;

Route::get('/', [MainController::class, 'index'])->name('main.index');

Route::get('/about-us', [MainController::class, 'about_us'])->name('main.about_us');

Route::get('/search', [MainController::class, 'search'])->name('main.search');

Route::get('/delivery', [MainController::class, 'delivery'])->name('main.delivery');

Route::get('/contacts', [MainController::class, 'contacts'])->name('main.contacts');

Route::get('/feedback', [FeedbackController::class,'feedbackPage'])->name('feedback');

Route::post('/feedback/send', [FeedbackController::class, 'feedbackSend'])->name('feedback.send');

// Роуты продуктов
Route::prefix('products')->name('products.')->group( function () {
    Route::get('/', Product\IndexController::class)->name('index');
    Route::post('/', Product\StoreController::class)->name('store');
    Route::get('/create', Product\CreateController::class)->name('create');
    Route::get('/{product}/edit', Product\EditController::class)->name('edit');
    Route::put('/{product}', Product\UpdateController::class)->name('update');
    Route::get('/{product}', Product\ShowController::class)->name('show');

    Route::delete('/product-image/{image}', Product\DeleteImageController::class)->name('image.delete');
    Route::delete('/{product}',Product\DeleteController::class)->name('delete');
});
// Роуты категорий
Route::prefix('categories')->name('categories.')->group( function () {
    Route::post('/', [CategoryController::class, 'store'])->name('store');
    Route::get('/{category}/edit', [CategoryController::class, 'edit'])->name('edit');
    Route::patch('/{category}',[CategoryController::class, 'update'])->name('update');
    Route::delete('/{category}',[CategoryController::class, 'destroy'])->name('delete');
});
// Роуты тегов
Route::prefix('tags')->name('tags.')->group(function () {
    Route::post('/',       [TagController::class,'store'])->name('store');
    Route::get ('/{tag}/edit',[TagController::class,'edit'])->name('edit');
    Route::patch('/{tag}', [TagController::class,'update'])->name('update');
    Route::delete('/{tag}',[TagController::class,'destroy'])->name('delete');

    Route::get('/search-json',[TagController::class,'searchJson'])->name('search.json');
    Route::get('/locate',[TagController::class,'locate'])->name('locate');
});
// Роуты корзины
Route::prefix('cart')->name('cart.')->group(function () {
    Route::get('/',[CartController::class, 'index'])->name('index');

    Route::post('/add', [CartController::class, 'add_to_cart'])->name('add');
    Route::post('/add-from-wishlist/{rowId}', [CartController::class, 'add_to_cart_from_wishlist'])->name('add.from.wishlist');

    Route::put('/increase-quantity/{rowId}',[CartController::class, 'increase_cart_quantity'])->name('qty.increase');
    Route::put('/decrease-quantity/{rowId}',[CartController::class, 'decrease_cart_quantity'])->name('qty.decrease');

    Route::delete('/remove/{rowId}', [CartController::class, 'remove_item'])->name('item.remove');
    Route::delete('/clear', [CartController::class, 'empty_cart'])->name('destroy');

    Route::get('/order/submit', [CartController::class, 'cart_submit'])->name('submit.order');
    Route::post('/order', [CartController::class, 'send_order'])->middleware('throttle:5,10')->name('checkout');
    Route::get('/order/thanks', [CartController::class, 'order_thanks'])->name('thanks.order');
});

// Роуты вишлиста
Route::prefix(prefix: 'wishlist')->name('wishlist.')->group(function () {
    Route::get('/',[WishlistController::class, 'index'])->name('index');
    Route::post('/add', [WishlistController::class, 'add_to_wishlist'])->name('add');
    Route::delete('/remove/{rowId}', [WishlistController::class, 'remove_item'])->name('item.remove');
    Route::delete('/clear', [WishlistController::class, 'empty_wishlist'])->name('destroy');
});

Route::middleware('guest')->group(function () {
    Route::get('admin', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    Route::post('/admin', [AuthenticatedSessionController::class, 'store']);
});

Route::middleware(['auth'])->group(function () {
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
            ->name('logout');
});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::middleware(['auth'])->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/products/search-json', [DashboardController::class, 'searchJson']);
        Route::get('/products/locate', [DashboardController::class, 'locate'])->name('products.locate');
        Route::get('manage-products', [DashboardController::class, 'product_manage'])->name('manage.products');
        Route::get('manage-categories', [CategoryController::class, 'category_manage'])->name('manage.categories');
        Route::get('manage-tags', [DashboardController::class, 'tag_manage'])->name('manage.tags');
    });
});