<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\{ProfileController,ProductController,PurchaseController};
use Illuminate\Support\Facades\Route;

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

Route::get('/', [HomeController::class, 'index'])->name('index');
Route::get('/checkout', [ProductController::class, 'show'])->name('checkout');
Route::post('/submitcheckout', [PurchaseController::class, 'purchaseProduct'])->name('submitcheckout');

Route::middleware('auth')->group(function () {
    Route::get('dashboard', [HomeController::class, 'dashboard'])->name('dashboard');
    Route::get('access-cancellation', [HomeController::class, 'accessCancellation'])->name('access-cancellation');
    Route::get('purchase-cancellation', [PurchaseController::class, 'purchaseCancellation'])->name('purchase-cancellation');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
