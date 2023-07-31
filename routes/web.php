<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\OfficeController;
use App\Http\Controllers\RecordController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\OfficeRecordController;
use App\Http\Controllers\UserController;
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
            Route::get('/{office?}', 'index')->name('offices'); 
            Route::get('/v/{office}', 'index')->name('offices.open');
            Route::post('/new/{office?}', 'create')->name('offices.new'); 
            Route::post('/update/{office}', 'update')->name('offices.update'); 
            Route::post('/delete/{office}', 'delete')->name('offices.delete'); 
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
            Route::get('/getTaggedOffice/{officeRecord}', 'get_tagged_office')->name('or_taaged_office');
            Route::post('/search/{search?}/ex/{excludes?}', 'search')->name('or_search');
            Route::post('/new', 'add_records_to_office')->name('or_new');
        });
    });

    Route::controller(DocumentController::class)->group(function () {
        Route::prefix('documents')->group(function () {
            Route::get('/', 'index')->name('documents');
            Route::get('/view', 'open')->name('documents.view');

        });
    });

    Route::controller(UserController::class)->group(function () {
        Route::prefix('users')->group(function () {
            Route::get('/', 'index')->name('users');
            Route::post('/search/{search?}', 'userSearch')->name('users.search');
        });
    });
    
    Route::get('/task', function () {
        return Inertia::render('Tasks');
    })->name('task');

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
