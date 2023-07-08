<?php

use App\Http\Livewire\Auth;
use App\Http\Livewire\User;
use App\Http\Livewire\Schema;
use App\Http\Livewire\LogUser;
use App\Http\Livewire\Category;
use App\Http\Livewire\Dashboard;
use App\Http\Livewire\MyProfile;
use App\Http\Livewire\Worksheet;
use App\Http\Livewire\MyPassword;
use App\Http\Livewire\LogActivity;
use App\Http\Livewire\Maintenance;
use App\Http\Livewire\Preliminary;
use App\Http\Livewire\Backup;
use App\Http\Livewire\SettingGeneral;
use App\Http\Livewire\SettingWebicon;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\Schema\SchemaController;

Route::middleware(['onproduction'])->group(function(){
    Route::get('/optimize', function(){
        Artisan::call('view:clear');
        Artisan::call('optimize');
        return 'Optimized';
    });
    Route::get('/symlink', function(){
        Artisan::call('storage:link');
        return 'Storage Linked';
    });
    Route::get('/migrate', function(){
        Artisan::call('migrate');
        return 'Migrated';
    });
    Route::get('/seed', function(){
        Artisan::call('db:seed');
        return 'DB Seed!';
    });
    Route::get('/deploy', function(){
        Artisan::call('deploy:now');
        return 'System Deployed!';
    });
});

Route::get('/', Dashboard\Index::class)->middleware(['auth']);
Route::get('/dashboard', Dashboard\Index::class)->middleware(['auth'])->name('dashboard');


/**
 * Auth
 */
Route::get('/login', Auth\Login::class)->middleware(['guest'])->name('login');


/**
 * Schemas
 */
Route::prefix('/schema')->middleware(['auth'])->group(function(){
    Route::get('/', Schema\Index::class);
    Route::get('/create', Schema\Create::class);
    Route::get('/edit/{id}', Schema\Edit::class);

    // Worksheet
    Route::get('/{id}/worksheet', Schema\Worksheet\Index::class);

    // Print : using Controller
    Route::get('/view/{id}', [SchemaController::class, 'view']);
});


/**
 * Categories
 */
Route::prefix('/category')->middleware(['auth','can:is_super, can:is_admin'])->group(function(){
    Route::get('/', Category\Index::class);
    Route::get('/create', Category\Create::class);
    Route::get('/edit/{id}', Category\Edit::class);
});


/**
 * Preleminaries
 */
Route::prefix('/preliminary')->middleware(['auth','can:is_super, can:is_admin'])->group(function(){
    Route::get('/', Preliminary\Index::class);
    Route::get('/create', Preliminary\Create::class);
    Route::get('/edit/{id}', Preliminary\Edit::class);
});


/**
 * Users
 */
Route::prefix('/user')->middleware(['auth','can:is_super, can:is_admin'])->group(function(){
    Route::get('/', User\Index::class);
    Route::get('/create', User\Create::class);
    Route::get('/edit/{id}', User\Edit::class);
});


/**
 * Logs
 */
Route::prefix('/logs')->middleware(['auth','can:is_super, can:is_admin'])->group(function(){
    Route::get('/activity', LogActivity\Index::class);
});


/**
 * Setting
 */
Route::prefix('/setting')->middleware(['auth','can:is_super, can:is_admin'])->group(function(){
    Route::get('/general', SettingGeneral\Index::class);

    Route::get('/webicon', SettingWebicon\Index::class);
});



/**
 * Backup
 */
Route::prefix('/backup')->middleware(['auth', 'can:is_super'])->group(function(){
    Route::get('/', Backup\Index::class);
});


/**
 * Maintenance
 */
Route::prefix('/maintenance')->middleware(['auth', 'can:is_super'])->group(function(){
    Route::get('/', Maintenance\Index::class);
});


/**
 * My
 */
Route::prefix('/my')->middleware(['auth'])->group(function(){
    Route::get('/password', MyPassword\Index::class);

    Route::get('/profile', MyProfile\Index::class);
});
