<?php

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

Route::get('/',[App\Http\Controllers\HomeController::class,'index']);
Route::get('/get-address',[App\Http\Controllers\site\postalController::class,'getDetailByPostalCode']);
Route::post('/new-complain',[App\Http\Controllers\site\ComplaianController::class,'store']);

Route::get('/view-service/{id}',[App\Http\Controllers\PageController::class,'serviceDetail']);
Route::get('/get-service-selection-image',[App\Http\Controllers\PageController::class,'getServiceSelectionImageView']);

Route::get('/admin-login',[App\Http\Controllers\Admin\AdminController::class,'login'])->name('login');

Route::post('/admin-login', [App\Http\Controllers\Admin\AdminController::class,'authenticate']);
Route::post('/admin-logout', [App\Http\Controllers\Admin\AdminController::class,'logout']);





//admin
Route::middleware(['auth:admin'])->group(function () {
//services
Route::get('/admin-dashboard', function(){
    return view('admin.home');
});
Route::get('/admin-services',[App\Http\Controllers\Admin\ServiceController::class,'index']);
Route::get('/admin-gallery',[App\Http\Controllers\Admin\Gallery\ServiceGalleryController::class,'index']);


Route::post('/store-service',[App\Http\Controllers\Admin\ServiceController::class,'store']);

Route::get('/create-service',[App\Http\Controllers\Admin\ServiceController::class,'create']);
Route::get('/manage-gallery/{type}',[App\Http\Controllers\Admin\Gallery\ServiceGalleryController::class,'show']);
Route::get('/create-gallery/{type}',[App\Http\Controllers\Admin\Gallery\ServiceGalleryController::class,'create']);
Route::post('/store-gallery',[App\Http\Controllers\Admin\Gallery\ServiceGalleryController::class,'store']);
Route::get('/drop-gallery/{id}',[App\Http\Controllers\Admin\Gallery\ServiceGalleryController::class,'destroy']);

Route::get('/edit-service/{id}',[App\Http\Controllers\Admin\ServiceController::class,'edit']);

Route::get('/service-samples/{id}',[App\Http\Controllers\Admin\Service\ServiceSampleController::class,'index']);

Route::get('/service-selections/{id}',[App\Http\Controllers\Admin\Service\ServiceSelectionController::class,'index']);
Route::get('/service-selection-images/{id}',[App\Http\Controllers\Admin\Service\ServiceSelectionController::class,'image']);
Route::get('/create-selection-image/{id}',[App\Http\Controllers\Admin\Service\ServiceSelectionController::class,'addImage']);
Route::post('/store-selection-image',[App\Http\Controllers\Admin\Service\ServiceSelectionController::class,'storeImage']);
Route::get('/drop-selection-image/{id}',[App\Http\Controllers\Admin\Service\ServiceSelectionController::class,'destroyImage']);

Route::get('/service-packages/{id}',[App\Http\Controllers\Admin\Service\ServicePackageController::class,'index']);

Route::get('/create-service-sample/{id}',[App\Http\Controllers\Admin\Service\ServiceSampleController::class,'create']);
Route::post('/store-service-sample',[App\Http\Controllers\Admin\Service\ServiceSampleController::class,'store']);
Route::get('/drop-service-sample/{id}',[App\Http\Controllers\Admin\Service\ServiceSampleController::class,'destroy']);

Route::get('/create-service-selection/{id}',[App\Http\Controllers\Admin\Service\ServiceSelectionController::class,'create']);
Route::post('/store-service-selection',[App\Http\Controllers\Admin\Service\ServiceSelectionController::class,'store']);
Route::get('/edit-service-selection/{id}',[App\Http\Controllers\Admin\Service\ServiceSelectionController::class,'edit']);
Route::get('/drop-service-selection/{id}',[App\Http\Controllers\Admin\Service\ServiceSelectionController::class,'destroy']);

Route::get('/create-service-package/{id}',[App\Http\Controllers\Admin\Service\ServicePackageController::class,'create']);
Route::post('/store-service-package',[App\Http\Controllers\Admin\Service\ServicePackageController::class,'store']);
Route::get('/edit-service-package/{id}',[App\Http\Controllers\Admin\Service\ServicePackageController::class,'edit']);
Route::get('/drop-service-package/{id}',[App\Http\Controllers\Admin\Service\ServicePackageController::class,'destroy']);

Route::get('/admin-recent-events',[App\Http\Controllers\Admin\Recent_events\RecentEventController::class,'index']);
Route::get('/create-recent-events',[App\Http\Controllers\Admin\Recent_events\RecentEventController::class,'create']);
Route::post('/store-recent-event',[App\Http\Controllers\Admin\Recent_events\RecentEventController::class,'store']);
Route::get('/edit-recent-event/{id}',[App\Http\Controllers\Admin\Recent_events\RecentEventController::class,'edit']);
Route::get('/drop-recent-event/{id}',[App\Http\Controllers\Admin\Recent_events\RecentEventController::class,'destroy']);
Route::get('/admin-recent-event-image/{id}',[App\Http\Controllers\Admin\Recent_events\RecentEventGalleryController::class,'index']);
Route::get('/create-recent-event-image/{id}',[App\Http\Controllers\Admin\Recent_events\RecentEventGalleryController::class,'create']);
Route::post('/store-recent-event-image',[App\Http\Controllers\Admin\Recent_events\RecentEventGalleryController::class,'store']);
Route::get('/drop-recent-event-image/{id}',[App\Http\Controllers\Admin\Recent_events\RecentEventGalleryController::class,'destroy']);

Route::get('/admin-home-gallery',[App\Http\Controllers\Admin\Gallery\HomeGalleryController::class,'index']);
Route::get('/create-home-gallery',[App\Http\Controllers\Admin\Gallery\HomeGalleryController::class,'create']);
Route::post('/store-home-gallery',[App\Http\Controllers\Admin\Gallery\HomeGalleryController::class,'store']);
Route::get('/drop-home-gallery/{id}',[App\Http\Controllers\Admin\Gallery\HomeGalleryController::class,'destroy']);
});