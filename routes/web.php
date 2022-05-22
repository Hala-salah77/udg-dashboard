<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactsController;
use App\Http\Controllers\UsersInfoController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ApplicantsController;
use App\Http\Controllers\EventsImagesController;
use App\Http\Controllers\ExhibitionsController;
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
    return view('/welcome');
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/activate', [App\Http\Controllers\HomeController::class, 'activate']);


Route::get('/listMessages', [ContactsController::class, 'list'])->middleware('auth');
Route::get('/listMessages/{id}', [ContactsController::class, 'deleteContact'])->middleware('auth');

Route::get('/listUsersInfo', [UsersInfoController::class, 'listUsersInfo'])->middleware('auth');
Route::get('/usersInfo/{id}', [UsersInfoController::class, 'deleteUserInfo'])->middleware('auth');

Route::get('/createNews', [NewsController::class, 'create'])->middleware('auth');
Route::post('/addNews/store', [NewsController::class, 'store'])->middleware('auth');
Route::get('/listNews', [NewsController::class, 'list'])->middleware('auth');
Route::get('/news/{id}', [NewsController::class, 'deleteNew'])->middleware('auth');
Route::post('/updateNews/{id}', [NewsController::class, 'update'])->middleware('auth');

Route::get('/listApplicants', [ApplicantsController::class, 'listApplicants'])->middleware('auth');
Route::get('/listApplicants/{id}', [ApplicantsController::class, 'deleteApplicant'])->middleware('auth');


##EventsImagesController Routes##
Route::get('/createEvent', [EventsImagesController::class, 'create'])->middleware('auth');
Route::post('/addEvents/store', [EventsImagesController::class, 'store'])->middleware('auth');
Route::get('/listEvents', [EventsImagesController::class, 'list'])->middleware('auth');
Route::get('/events/{id}', [EventsImagesController::class, 'deleteEvent'])->middleware('auth');
Route::post('/updateEvents/{id}', [EventsImagesController::class, 'update'])->middleware('auth');

##ExhibitionsController Routes##
Route::get('/createExhibition', [ExhibitionsController::class, 'create'])->middleware('auth');
Route::post('/addExhibition/store', [ExhibitionsController::class, 'store'])->middleware('auth');
Route::get('/listExhibitions', [ExhibitionsController::class, 'list'])->middleware('auth');
Route::get('/exhibitions/{id}', [ExhibitionsController::class, 'deleteExhibition'])->middleware('auth');
Route::post('/updateExhibition/{id}', [ExhibitionsController::class, 'update'])->middleware('auth');

