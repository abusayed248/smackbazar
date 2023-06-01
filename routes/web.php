<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\FruitcasteController;
use App\Http\Controllers\Admin\GardenController;
use App\Http\Controllers\Admin\SubcatController;
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

Auth::routes();

Route::get('/admin/login',[LoginController::class,'showAdminLoginForm'])->name('admin.login-view');
Route::post('/admin/login',[LoginController::class,'adminLogin'])->name('admin.login');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// =======================================//
// =======================================//
//admin route start here
Route::group(['prefix' => 'admin', 'as' => 'admin.','middleware' => 'auth:admin'], function ()
{
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::get('/logout', [AdminController::class, 'logout'])->name('logout');

    // ================= Category route start ======================//
    Route::resource('category', CategoryController::class);
    Route::get('/category-delete/{category}', [CategoryController::class, 'destroy'])->name('category.destroy');
    Route::get('/category-status/active/{category}', [CategoryController::class, 'activeStatus'])->name('category.status.active');
    Route::get('/category-status/inactive/{category}', [CategoryController::class, 'inactiveStatus'])->name('category.status.inactive');
    // ================= Category route end ======================//

    // ================= Sub-Category route start ======================//
    Route::resource('subcat', SubcatController::class);
    Route::get('/subcat-delete/{subcat}', [SubcatController::class, 'destroy'])->name('subcat.destroy');
    Route::get('/subcat-status/active/{subcat}', [SubcatController::class, 'activeStatus'])->name('subcat.status.active');
    Route::get('/subcat-status/inactive/{subcat}', [SubcatController::class, 'inactiveStatus'])->name('subcat.status.inactive');

    // ================= Caste route start ======================//
    Route::resource('caste', FruitcasteController::class);
    Route::get('/caste-delete/{fruitcaste}', [FruitcasteController::class, 'destroy'])->name('caste.destroy');
    Route::get('/caste-status/active/{fruitcaste}', [FruitcasteController::class, 'activeStatus'])->name('caste.status.active');
    Route::get('/caste-status/inactive/{fruitcaste}', [FruitcasteController::class, 'inactiveStatus'])->name('caste.status.inactive');
    // ================= Caste route end ======================//

    // ================= Garden route start ======================//
    Route::resource('garden', GardenController::class);
    Route::get('/garden-delete/{garden}', [GardenController::class, 'destroy'])->name('garden.destroy');
    Route::get('/garden-status/active/{garden}', [GardenController::class, 'activeStatus'])->name('garden.status.active');
    Route::get('/garden-status/inactive/{garden}', [GardenController::class, 'inactiveStatus'])->name('garden.status.inactive');
    // ================= Garden route end ======================//



});