<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/test', function() {
    return view("pages.dashboard.ecommerce");
});

Route::get('/', function () {
    if(!Auth::check()){
        return redirect()->route('login');
    }
    return redirect('/redirect');
});


Auth::routes();

Route::get('/redirect', function () {
    $user = Auth::user();

    if ($user->role === 'superadmin') {
        return redirect()->route('superadmin.dashboard');
    }

    if ($user->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }

    if ($user->role === 'staff') {
        return redirect()->route('staff.dashboard');
    }

    abort(403);
})->middleware('auth');


Route::middleware(['auth'])->group(function () {

    Route::prefix('superadmin')->group(function () {
        Route::middleware(['can:isSuperAdmin'])->group(function () {
            Route::get('dashboard', [App\Http\Controllers\SuperAdminController::class, 'index'])->name('superadmin.dashboard');
        });
    });
    Route::prefix('admin')->group(function () {
        Route::middleware(['can:isAdmin'])->group(function () {
            Route::get('dashboard', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.dashboard');
        });
    });
    Route::prefix('staff')->group(function () {
        Route::middleware(['can:isStaff'])->group(function () {
            Route::get('dashboard', [App\Http\Controllers\StaffController::class, 'index'])->name('staff.dashboard');
        });
    });

    Route::resource('pusats', App\Http\Controllers\PusatController::class);
    Route::resource('users', App\Http\Controllers\UserController::class);
    Route::resource('fnb', App\Http\Controllers\FnBController::class);
    Route::resource('kotas', App\Http\Controllers\KotaController::class);
    Route::resource('provinsis', App\Http\Controllers\ProvinsiController::class);
    Route::resource('jenis_mejas', App\Http\Controllers\JenisMejaController::class);
    Route::resource('mejas', App\Http\Controllers\MejaController::class);
    Route::resource('transactions', App\Http\Controllers\TransactionController::class);

});