<?php

use App\Http\Controllers\Admin\ApartmentController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\TomTomController;
use App\Http\Controllers\Admin\MessageController;
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
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('admin.dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        Route::resource('apartments', ApartmentController::class)->parameters(['apartments' => 'apartment:slug']);
        Route::get('/tomtom', [TomTomController::class, 'index'])->name('tomtom');
        Route::get('messages', [MessageController::class, 'index'])->name('messages.index');
        Route::get('messages/{id}', [MessageController::class, 'show'])->name('messages.show');
    });


require __DIR__ . '/auth.php';

////////////////////
// Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
// Route::resource('projects', ProjectController::class)->parameters(['apartments' => 'apartment:slug']);
// Route::resource('types', TypeController::class)->parameters(['types' => 'type:slug'])->except('create', 'edit');
// Route::resource('technologies', TechnologyController::class)->parameters(['technologies' => 'technology:slug'])->except('create', 'edit');
