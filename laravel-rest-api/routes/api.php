<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Http\Controllers\UserApiController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ImportController;


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

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

Route::post('import', [ImportController::class, 'import'])->name('import');

//Route::middleware('auth:api')->group(function () {
Route::group(['middleware'  =>  'auth:api'], function (){ 
    //Protected routes will go in here

    //Read all users
    Route::get('/users', [UserApiController::class, 'AllUser']);

    //CREATE (create the user)
    Route::post('/users', [UserApiController::class, 'create']);
    
    //READ (GET a users)
    Route::get('/users/{id}', [UserApiController::class, 'GetUser']);

    //UPDATE (updates existing users)
    Route::put('/users/{id}', [UserApiController::class, 'update']);

    //DELETE (delete a user)
    Route::delete('/users/{id}', [UserApiController::class, 'delete']);
    
    //LOGOUT
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout.api');
});
