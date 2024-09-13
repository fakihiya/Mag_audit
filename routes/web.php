<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MissionController;
use App\Http\Controllers\NormeController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\RapportController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VisiteController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('Auth.login');
});

//Auth
Route::get('/login', [LoginController::class, 'loginForm'])->name('login');

Route::post('/login', [LoginController::class, 'login'])->name('newlogin');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/register', [LoginController::class, 'index'])->name('register');

Route::post('/register', [LoginController::class, 'register'])->name('newregister');



    // Routes accessible only to users with 'admin' role
    // Route::get('/hotel', [HotelController::class,'index'])->name('showHotels');
    // Route::delete('/delete/{id}', [HotelController::class, 'destroy'])->name('hotel.delete');
    // Route::post('/Add_hotels', [HotelController::class,'store'])->name('add_hotel');
    // Route::put('/update_hote/{id}', [HotelController::class, 'update'])->name('hotel.update');

    // //user
    // Route::get('/users', [UserController::class,'index'])->name('showusers');
    // Route::delete('/remove/{id}',[UserController::class, 'destroy'])->name('user.delete');
    // Route::post('/Add_Users', [UserController::class,'store'])->name('add_user');
    // Route::put('/users/{id}', [UserController::class,'update'])->name('user.update');

Route::middleware(["auth",'super admin'])->group(function () {
    // Routes accessible only to users with 'admin' role
    Route::get('/hotel', [HotelController::class,'index'])->name('showHotels');
    Route::delete('/delete/{id}', [HotelController::class, 'destroy'])->name('hotel.delete');
    Route::post('/Add_hotels', [HotelController::class,'store'])->name('add_hotel');
    Route::put('/update_hote/{id}', [HotelController::class, 'update'])->name('hotel.update');
    Route::post('/hotels/search', [HotelController::class, 'search'])->name('hotels.search');
    Route::resource('hotels', HotelController::class);


    //user
    Route::get('/users', [UserController::class,'index'])->name('showusers');
    Route::delete('/remove/{id}',[UserController::class, 'destroy'])->name('user.delete');
    Route::post('/Add_Users', [UserController::class,'store'])->name('add_user');
    Route::put('/users/{id}', [UserController::class,'update'])->name('user.update');
});


Route::get('/profile', [UserController::class, 'profile'])->name('show_profile');
Route::put('/profile/update', [UserController::class, 'updateProfile'])->name('profile.update');



//mission
Route::get('/mission', [MissionController::class, 'displayMission'])->name('showmisson');
Route::get('/details/{ID_Mission}', [MissionController::class, 'details'])->name('details');
Route::post('/Add_mission', [MissionController::class, 'store'])->name('add_missions');
Route::get('/missions/{mission}/edit', [MissionController::class, 'edit'])->name('missions.edit');
Route::put('/missions/{mission}', [MissionController::class, 'update'])->name('missions.update');
Route::delete('/missions/{mission}', [MissionController::class, 'destroy'])->name('missions.destroy');
Route::post('/missions/search', [MissionController::class, 'search'])->name('missions.search');

//normes
Route::resource('normes', NormeController::class);

Route::get('/norm/{hotel_id}/{legende_id}', [NormeController::class,'index'])->name('shownorm');

//overview

Route::middleware(["auth"])->get('/overview', [HomeController::class,'index'])->name('overview');

    Route::get('home', function () {
        return view('dashboard/home');
    })->name('home');


Route::get('/login', [LoginController::class, 'loginForm'])->name('login');

// rapport routesss

Route::get('/rapport/{hotel_id}/{legende_id}', [RapportController::class, 'index'])->name('page_rapport');
Route::post('/voirRapport', [RapportController::class, 'voirRapport'])->name('voir_rapport');


// Route::get('/rapport/download-pdf/{hotel_id}/{legende_id}', [RapportController::class, 'downloadPdf'])->name('rapport.downloadPdf');


// Route::get('rapport/{hotel_id}/{legende_id}/pdf', [RapportController::class, 'downloadPdf'])->name('generate_pdf');


Route::get('/download-rapport/{hotel_id}/{legende_id}/{ID_Mission}', [RapportController::class, 'downloadRapport'])->name('download.rapport');


Route::get('/generate-pdf/{hotel_id}/{legende_id}/{ID_Mission}', [RapportController::class, 'generatePdf'])->name('generate_pdf');


// Route::get('/generate-pdf', [PDFController::class, 'generatePDF'])->name('generate_pdf');

//resume

// Route::get('/missionsshow/{id}', [NormeController::class, 'showRe'])->name('missions.show');
Route::post('/missions/{id}/store-resume', [NormeController::class, 'storeResume'])->name('missions.storeResume');







Route::post('/save-normes', [NormeController::class, 'saveNormes'])->name('save.normes');
Route::post('/get-stored-responses', [NormeController::class, 'getStoredResponses'])->name('get.stored.responses');

Route::post('/visites', [VisiteController::class, 'store'])->name('visites.store');