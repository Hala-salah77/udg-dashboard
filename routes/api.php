<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ContactsController;
use App\Http\Controllers\Api\UsersInfoController;
use App\Http\Controllers\Api\NewsController;
use App\Http\Controllers\Api\ApplicantsController;
use App\Http\Controllers\Api\ActivationApplicantsController;
use App\Http\Controllers\Api\EventsController;
use App\Http\Controllers\Api\ExhibitionController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('listContacts',[ContactsController::class,'listContacts']);
Route::post('sendContactInfo',[ContactsController::class,'sendContactInfo']);

Route::get('listUsersInfo',[UsersInfoController::class,'listUsersInfo']);
Route::post('sendUsersInfo',[UsersInfoController::class,'sendUsersInfo']);

Route::get('listNews',[NewsController::class,'list']);
Route::post('sendNews',[NewsController::class,'store']);

Route::post('sendApplication',[ApplicantsController::class,'store']);
Route::get('listApplicants',[ApplicantsController::class,'listApplicants']);

Route::get('/getActivate', [ActivationApplicantsController::class, 'getActivate']);

Route::get('/listEvents', [EventsController::class, 'list']);
Route::get('/listExhibition', [ExhibitionController::class, 'list']);