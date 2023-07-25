<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\OfficeController;
use App\Http\Controllers\RecordController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\OfficeRecordController;
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

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
    
    Route::controller(OfficeController::class)->group(function () {
        Route::prefix('offices')->group(function () { 
            Route::get('/', 'index')->name('offices'); 
            Route::post('/new/{office?}', 'create')->name('offices.new'); 
            Route::post('/update/{office}', 'update')->name('offices.update'); 
            Route::get('/repository/{current}', 'open_repository')->name('offices.repo'); 
        });
    });
    
    Route::controller(RecordController::class)->group(function () {
        Route::prefix('records')->group(function () {
            Route::get('/', 'index')->name('records');
            Route::get('/r/{record?}', 'open_record')->name('records.open');
            Route::post('/new/{record?}', 'create')->name('records.new');
            Route::post('/update/{record}', 'update')->name('records.update');
        });
    });

    Route::controller(OfficeRecordController::class)->group(function () {
        Route::prefix('officeRecords')->group(function () {
            Route::post('/search/{search?}', 'search')->name('or_search');
            Route::post('/new', 'add_records_to_office')->name('or_new');
        });
    });

    Route::controller(DocumentController::class)->group(function () {
        Route::prefix('documents')->group(function () {
            Route::get('/', 'index')->name('documents');
            Route::get('/view', 'open')->name('documents.view');

        });
    });
    
    Route::get('/task', function () {
        return Inertia::render('Tasks');
    })->name('task');
    
    Route::get('/users', function () {
        return Inertia::render('Users');
    })->name('users');

});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
