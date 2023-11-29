<?php

use App\Http\Controllers\API\DrugsController;
use App\Http\Controllers\API\OrderController;
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

Route::post('user/register', [UserController::class, 'registerUser']);
Route::post('user/login', [UserController::class, 'signInUser']);
Route::get('users', [UserController::class, 'getAllUsers']);
Route::delete('delete_user/{id}', [UserController::class, 'deleteUser']);
Route::put('update_user/{id}', [UserController::class, 'updateUser']);

Route::get('get_stats', [UserController::class, 'getStats']);


// Route::post('recipe/addToCookBook', [RecipeController::class, 'addToCookBook']);
// Route::post('recipe/getCookBook', [RecipeController::class, 'getCookBook']);
Route::post('register', [UserController::class, 'registerUser']);


Route::get('all_drugs', [DrugsController::class, 'getAllDrugs']);
Route::get('fetch_drug/{id}', [DrugsController::class, 'getSpecificDrug']);
Route::get('fetch_categorical/{category}', [DrugsController::class, 'getCategoricalDrugs']);
Route::post('add_drugs', [DrugsController::class, 'addDrugs']);
Route::put('edit_drug/{id}', [DrugsController::class, 'editDrug']);
Route::delete('delete_drug/{id}', [DrugsController::class, 'deleteDrug']);

Route::get('all_categories', [DrugsController::class, 'getAllCategories']);
Route::post('add_category', [DrugsController::class, 'addCategory']);

Route::post('add_order', [OrderController::class, 'addOrder']);
