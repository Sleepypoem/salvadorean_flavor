<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\IngredientController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\UserController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/* ***************************************************************** Admin routes ***************************************************************** */
Route::post("/v1/register", [AuthController::class, 'register']);
Route::post("/v1/login", [AuthController::class, 'login']);
Route::post("/v1/user_info", [AuthController::class, 'userInfo'])->middleware("auth:sanctum");
/* ************************************************************************************************************************************************ */

/* ****************************************************************** User Routes ***************************************************************** */
Route::get("/v1/users", [UserController::class, "index"]);
Route::get("/v1/user/{user}", [UserController::class, "show"]);
Route::post("/v1/user", [UserController::class, "store"]);
Route::put("/v1/user/{user}", [UserController::class, "update"]);
Route::delete("/v1/user/{user}", [UserController::class, "destroy"]);
/* ************************************************************************************************************************************************ */

/* **************************************************************** Recipes routes **************************************************************** */
Route::get("/v1/recipes", [RecipeController::class, "index"]);
/* ************************************************************************************************************************************************ */

/* *************************************************************** Ingredient routes ************************************************************** */
Route::get("/v1/ingredients", [IngredientController::class, "index"]);
Route::post("/v1/ingredient", [IngredientController::class, "store"]);
Route::put("/v1/ingredient/{id}", [IngredientController::class, "update"]);
Route::delete("/v1/ingredient/{id}", [IngredientController::class, "destroy"]);
/* ************************************************************************************************************************************************ */
/* *************************************************************** Tags routes ************************************************************** */
Route::get("/v1/tags", [TagsController::class, "index"]);
Route::get("/v1/tags/{tags}", [TagsController::class, "show"]);
Route::post("/v1/tags", [TagsController::class, "store"]);
Route::put("/v1/tags/{tags}", [TagsController::class, "update"]);
Route::delete("/v1/tags/{tags}", [TagsController::class, "destroy"]);
/* ************************************************************************************************************************************************ */