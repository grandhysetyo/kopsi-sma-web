<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
// Import Controller
use App\Http\Controllers\FrontendController;

Route::get('/semua-informasi', [FrontendController::class, 'all_info']);
Route::get('/informasi', [FrontendController::class, 'info']);
Route::get('/linimasa', [FrontendController::class, 'linimasa']);
Route::get('/informasi/{informasi}', [FrontendController::class, 'detail_info']);
