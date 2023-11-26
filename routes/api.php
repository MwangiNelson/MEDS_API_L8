<?php

use App\Http\Controllers\API\DrugsController;
use App\Http\Controllers\API\RecipeController;
use App\Http\Controllers\API\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::get('recipes', [RecipeController::class, 'getAllRecipes']);
// Route::get('recipes/topRecipes', [RecipeController::class, 'getTopRecipes']);
// Route::get('recipes/{id}', [RecipeController::class, 'getSpecificRecipe']);
// Route::post('recipes', [RecipeController::class, 'addRecipe']);

// Route::post('user/sign-up', [UserController::class, 'registerUser']);
// Route::post('user/sign-in', [UserController::class, 'signInUser']);


// Route::post('recipe/addToCookBook', [RecipeController::class, 'addToCookBook']);
// Route::post('recipe/getCookBook', [RecipeController::class, 'getCookBook']);

Route::get('all_drugs', [DrugsController::class, 'getAllDrugs']);
Route::post('add_drugs', [DrugsController::class, 'addDrugs']);


