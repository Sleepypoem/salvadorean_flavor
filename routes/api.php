<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\IngredientController;
use App\Http\Controllers\TagsController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
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
Route::get("/v1/users", [AuthController::class, "index"]);
Route::post("/v1/register", [AuthController::class, 'register']);
Route::post("/v1/login", [AuthController::class, 'login']);
Route::post("/v1/user_info", [AuthController::class, 'userInfo'])->middleware("auth:sanctum");
Route::put("/v1/user/{user}", [AuthController::class, "update"]);
Route::delete("/v1/user/{user}", [AuthController::class, "destroy"]);
/* ************************************************************************************************************************************************ */

/* **************************************************************** Recipes routes **************************************************************** */
Route::get("/v1/recipes", [RecipeController::class, "index"]);
Route::post("/v1/recipe", [RecipeController::class, "store"]);
Route::put("/v1/recipe/{id}", [RecipeController::class, "update"]);
Route::delete("/v1/recipe/{id}", [RecipeController::class, "destroy"]);
/* ************************************************************************************************************************************************ */

/* *************************************************************** Ingredient routes ************************************************************** */
Route::get("/v1/ingredients", [IngredientController::class, "index"]);
Route::get("/v1/ingredient/{ingredient}", [IngredientController::class, "show"]);
Route::post("/v1/ingredient", [IngredientController::class, "store"]);
Route::put("/v1/ingredient/{id}", [IngredientController::class, "update"]);
Route::delete("/v1/ingredient/{id}", [IngredientController::class, "destroy"]);
/* ************************************************************************************************************************************************ */
/* *************************************************************** Tags routes ************************************************************** */
Route::get("/v1/tags", [TagsController::class, "index"]);
Route::post("/v1/tag", [TagsController::class, "store"]);
Route::put("/v1/tag/{id}", [TagsController::class, "update"]);
Route::delete("/v1/tag/{id}", [TagsController::class, "destroy"]);
/* ************************************************************************************************************************************************ */

/* ***************************************************************** Roles routes ***************************************************************** */
Route::get("/v1/roles", [RoleController::class, "index"]);
Route::get("/v1/role/{role}", [RoleController::class, "show"]);
Route::post("/v1/role", [RoleController::class, "store"]);
Route::put("/v1/role/{role}", [RoleController::class, "update"]);
Route::delete("/v1/role/{role}", [RoleController::class, "destroy"]);
/* ************************************************************************************************************************************************ */

/* *************************************************************** Permission routes ************************************************************** */
Route::get("/v1/permissions", [PermissionController::class, "index"]);
Route::get("/v1/permission/{permission}", [PermissionController::class, "show"]);
Route::post("/v1/permission", [PermissionController::class, "store"]);
Route::put("/v1/permission/{permission}", [PermissionController::class, "update"]);
Route::delete("/v1/permission/{permission}", [PermissionController::class, "destroy"]);
/* ************************************************************************************************************************************************ */
/* **************************************************************** Categories routes **************************************************************** */
Route::get("/v1/categories", [CategoriesController::class, "index"]);
Route::post("/v1/category", [CategoriesController::class, "store"]);
Route::put("/v1/category/{id}", [CategoriesController::class, "update"]);
Route::delete("/v1/category/{id}", [CategoriesController::class, "destroy"]);
/* ************************************************************************************************************************************************ */

/* ***************************************************************** Image routes ***************************************************************** */
Route::get("/image/user/{filename}", [ImageController::class, "userImage"]);
Route::get("/image/recipe/{filename}", [ImageController::class, "recipeImage"]);
Route::get("/image/ingredient/{filename}", [ImageController::class, "ingredientImage"]);
/* ************************************************************************************************************************************************ */