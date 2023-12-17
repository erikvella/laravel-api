<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PageController;
use App\Http\Controllers\Api\LeadController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/projects' , [PageController::class , 'index']);
Route::get('/types' , [PageController::class , 'getTypes']);
Route::get('/tecnologies' , [PageController::class , 'getTecnologies']);
Route::get('/projects-by-type/{type_slug}' , [PageController::class , 'getProjectsByType']);
Route::get('/projects-by-tecnology/{tecnology_slug}' , [PageController::class , 'getProjectsByTecnology']);
Route::get('/projects/get-project/{slug}' , [PageController::class , 'getProjectBySlug']);
Route::get('/search/{tosearch}' , [PageController::class , 'search']);
Route::get('/send-email' , [LeadController::class , 'store']);


