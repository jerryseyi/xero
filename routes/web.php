<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\DraftInvoiceController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RecurringInvoiceController;
use App\Http\Controllers\XeroController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::get('/', [XeroController::class, 'index'])->name('home');
Route::get('/manage/xero', [XeroController::class, 'index'])->name('xero.auth.success');
Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/contacts', [ContactController::class, 'index'])->name('contact.index');
Route::post('/contacts', [ContactController::class, 'store'])->name('contact.store');
Route::get('/contacts/create', [ContactController::class, 'create'])->name('contact.create');

Route::post('/invoices/draft', [DraftInvoiceController::class, 'store'])->name('invoices.draft');
Route::post('/invoices/recurring', [RecurringInvoiceController::class, 'store'])->name('recurring.draft');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
