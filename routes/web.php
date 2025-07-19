<?php

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;

//  الصفحة الرئيسية لعرض الكتب
Route::get('/', [BookController::class, 'index'])->name('books.index');
Route::get('/book/{id}', [BookController::class, 'show'])->name('books.show');

// تسجيل الدخول وتسجيل مستخدم
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// صفحات الأدمن فقط
Route::middleware(['auth', 'is_admin'])->group(function () {
    Route::get('/admin/books', [BookController::class, 'adminIndex'])->name('admin.books');
    Route::get('/insert-book', [BookController::class, 'create'])->name('books.create');
    Route::post('/insert-book', [BookController::class, 'store'])->name('books.store');
    Route::get('/books/{id}/edit', [BookController::class, 'edit'])->name('books.edit');
    Route::put('/books/{id}', [BookController::class, 'update'])->name('books.update');
    Route::delete('/books/{id}', [BookController::class, 'destroy'])->name('books.destroy');
});


Route::middleware('auth')->group(function () {
    Route::post('/add-to-cart/{book}', [CartController::class, 'add'])->name('cart.add');
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::delete('/remove-from-cart/{book}', [CartController::class, 'remove'])->name('cart.remove');
    Route::post('/clear-cart', [CartController::class, 'clear'])->name('cart.clear');
    Route::put('/update-cart/{book}', [CartController::class, 'update'])->name('cart.update');
});

// categories

Route::get('/romantic', [HomeController::class, 'romanticBooks'])->name('romantic.books');
Route::get('/imagination', [HomeController::class, 'imaginationBooks'])->name('imagination.books');
Route::get('/fantasy', [HomeController::class, 'fantasyBooks'])->name('fantasy.books');
Route::get('/horror', [HomeController::class, 'horrorBooks'])->name('horror.books');
Route::get('/suspense', [HomeController::class, 'suspenseBooks'])->name('suspense.books');
Route::get('/crime', [HomeController::class, 'crimeBooks'])->name('crime.books');
Route::get('/social', [HomeController::class, 'socialBooks'])->name('social.books');
Route::get('/historical', [HomeController::class, 'historicalBooks'])->name('historical.books');
Route::get('/dramatic', [HomeController::class, 'dramaticBooks'])->name('dramatic.books');
Route::get('/subjective', [HomeController::class, 'subjectiveBooks'])->name('subjective.books');
Route::get('/all-novels', [HomeController::class, 'allNovels'])->name('all.novels');

Route::get('/search', [BookController::class, 'search'])->name('books.search');

Route::post('/contact/send', [ContactController::class, 'send'])->name('contact.send');

Route::middleware('auth')->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::get('/checkout', [CartController::class, 'checkout'])->name('checkout.form')->middleware('auth');
    Route::post('/checkout', [OrderController::class, 'store'])->name('checkout.store')->middleware('auth');
});

Route::get('/orders/thankyou', function () {
    return view('orders.thankyou');
})->name('orders.thankyou')->middleware('auth');

Route::middleware('auth')->group(function () {
    // تعديل الحساب الشخصي
    Route::get('/account/edit', [UserController::class, 'edit'])->name('account.edit');
    Route::post('/account/update', [UserController::class, 'update'])->name('account.update');

    // تعديل كلمة المرور
    Route::get('/account/password', [UserController::class, 'editPassword'])->name('account.password');
    Route::post('/account/password', [UserController::class, 'updatePassword'])->name('account.password.update');
});

Route::get('/my-orders', [OrderController::class, 'myOrders'])->name('orders.mine')->middleware('auth');

Route::get('/admin/orders', [OrderController::class, 'adminOrders'])->name('admin.orders')->middleware(['auth', 'is_admin']);

Route::get('/customer-service', function () {
    return view('customer-service');
})->name('customer.service');

Route::get('/my-account', [UserController::class, 'account'])->name('my.account')->middleware('auth');

Route::get('/my-orders', [OrderController::class, 'myOrders'])->name('user.orders');
