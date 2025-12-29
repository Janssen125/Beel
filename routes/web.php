<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

    Route::patch('/transaction/{id}/updateStatus', [App\Http\Controllers\TransactionController::class, 'updateStatus'])->name('transactions.updateStatus');
    
    Route::resource('pusats', App\Http\Controllers\PusatController::class);
    Route::resource('users', App\Http\Controllers\UserController::class);
    Route::resource('fnb', App\Http\Controllers\FnBController::class);
    Route::resource('kotas', App\Http\Controllers\KotaController::class);
    Route::resource('provinsis', App\Http\Controllers\ProvinsiController::class);
    Route::resource('jenis_mejas', App\Http\Controllers\JenisMejaController::class);
    Route::resource('mejas', App\Http\Controllers\MejaController::class);
    Route::resource('transactions', App\Http\Controllers\TransactionController::class);

// Template

// dashboard pages
Route::get('/template/dashboard', function () {
    return view('pages.template.dashboard.ecommerce', ['title' => 'E-commerce Dashboard']);
})->name('dashboard');

// calender pages
Route::get('/calendar', function () {
    return view('pages.template.calender', ['title' => 'Calendar']);
})->name('calendar');

// profile pages
Route::get('/profile', function () {
    return view('pages.template.profile', ['title' => 'Profile']);
})->name('profile');

// form pages
Route::get('/form-elements', function () {
    return view('pages.template.form.form-elements', ['title' => 'Form Elements']);
})->name('form-elements');

// tables pages
Route::get('/basic-tables', function () {
    return view('pages.template.tables.basic-tables', ['title' => 'Basic Tables']);
})->name('basic-tables');

// pages

Route::get('/blank', function () {
    return view('pages.template.blank', ['title' => 'Blank']);
})->name('blank');

// error pages
Route::get('/error-404', function () {
    return view('pages.template.errors.error-404', ['title' => 'Error 404']);
})->name('error-404');

// chart pages
Route::get('/line-chart', function () {
    return view('pages.template.chart.line-chart', ['title' => 'Line Chart']);
})->name('line-chart');

Route::get('/bar-chart', function () {
    return view('pages.template.chart.bar-chart', ['title' => 'Bar Chart']);
})->name('bar-chart');


// authentication pages
Route::get('/signin', function () {
    return view('pages.template.auth.signin', ['title' => 'Sign In']);
})->name('signin');

Route::get('/signup', function () {
    return view('pages.template.auth.signup', ['title' => 'Sign Up']);
})->name('signup');

// ui elements pages
Route::get('/alerts', function () {
    return view('pages.template.ui-elements.alerts', ['title' => 'Alerts']);
})->name('alerts');

Route::get('/avatars', function () {
    return view('pages.template.ui-elements.avatars', ['title' => 'Avatars']);
})->name('avatars');

Route::get('/badge', function () {
    return view('pages.template.ui-elements.badges', ['title' => 'Badges']);
})->name('badges');

Route::get('/buttons', function () {
    return view('pages.template.ui-elements.buttons', ['title' => 'Buttons']);
})->name('buttons');

Route::get('/image', function () {
    return view('pages.template.ui-elements.images', ['title' => 'Images']);
})->name('images');

Route::get('/videos', function () {
    return view('pages.template.ui-elements.videos', ['title' => 'Videos']);
})->name('videos');

});
