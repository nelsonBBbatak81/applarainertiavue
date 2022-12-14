<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\Admin\CategoriesController;

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
    return Inertia::render('Home/Index', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('admin/HomeAdmin');
    })->name('dashboard');

    // path for category admin
    Route::get('/categories', [CategoriesController::class, 'index'])->name('categories');
    Route::post('/categories/add', [CategoriesController::class, 'store'])->name('categories-add');
    Route::post('/categories/update/{id}', [CategoriesController::class, 'update'])->name('categories-update');
    Route::delete('/categories/delete/{id}', [CategoriesController::class, 'destroy'])->name('categories-delete');

    Route::get('/product', function () {
        return Inertia::render('admin/HomeAdmin');
    })->name('products');
});
