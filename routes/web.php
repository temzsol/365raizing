<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CompanyController;


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

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/',[AdminController::class,'login']);
Route::get('/logout',[AdminController::class,'logout']);
Route::post('/login',[AdminController::class,'AuthLogin'])->name('login');


Route::prefix('master-admin')->middleware('login')->group(function () {
    Route::get('/dashboard', [DashboardController::class,'index'])->name('master-dashboard');
    Route::resource('/task',BrandController::class);
    Route::resource('/company',CompanyController::class);
    
    // Route::get('/career','EnquiryController@career')->name('career');
    // Route::get('/subscribers','EnquiryController@subscriber')->name('subscribers');
    // Route::get('/subscribers/{id}','EnquiryController@subscriber_delete')->name('subscriber_delete');
    // Route::get('/career/{id}','EnquiryController@career_delete')->name('career_delete');
    // Route::post('/newsletters-send','NewsletterController@sendmail')->name('newsletters-send');
    // Route::resource('/testimonials',TestimonialController::class);
    // Route::resource('/jobs',JobController::class);

});

Route::get('/clear-cache', function() {
    Artisan::call('cache:clear ');
    Artisan::call('route:clear');
    Artisan::call('config:clear');
    Artisan::call('view:clear');
    echo Artisan::output();
});

Route::get('/command', function() {

    Artisan::call('make:model Language -mcr');
    Artisan::call('db:seed');
    Artisan::call('db:seed');
    echo Artisan::output();
});


