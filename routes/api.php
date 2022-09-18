<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\IngredientController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TagsController;
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
Route::get("/v1/users", [AuthController::class, "index"])->middleware("auth:sanctum")->middleware("auth:sanctum");
Route::post("/v1/register/admin", [AuthController::class, 'registerAdmin'])->middleware("auth:sanctum");
Route::post("/v1/register/user", [AuthController::class, 'registerUser']);
Route::post("/v1/login", [AuthController::class, 'login']);
Route::post("/v1/user_info", [AuthController::class, 'userInfo'])->middleware("auth:sanctum");
Route::put("/v1/user/{user}", [AuthController::class, "update"])->middleware("auth:sanctum");
Route::delete("/v1/user/{user}", [AuthController::class, "destroy"])->middleware("auth:sanctum");
/* ************************************************************************************************************************************************ */

/* **************************************************************** Recipes routes **************************************************************** */
Route::get("/v1/recipes", [RecipeController::class, "index"])->middleware("auth:sanctum");
Route::post("/v1/recipe", [RecipeController::class, "store"])->middleware("auth:sanctum");
Route::put("/v1/recipe/{id}", [RecipeController::class, "update"])->middleware("auth:sanctum");
Route::delete("/v1/recipe/{id}", [RecipeController::class, "destroy"])->middleware("auth:sanctum");
/* ************************************************************************************************************************************************ */

/* *************************************************************** Ingredient routes ************************************************************** */
Route::get("/v1/ingredients", [IngredientController::class, "index"])->middleware("auth:sanctum");
Route::get("/v1/ingredient/{ingredient}", [IngredientController::class, "show"])->middleware("auth:sanctum");
Route::post("/v1/ingredient", [IngredientController::class, "store"])->middleware("auth:sanctum");
Route::put("/v1/ingredient/{id}", [IngredientController::class, "update"])->middleware("auth:sanctum");
Route::delete("/v1/ingredient/{id}", [IngredientController::class, "destroy"])->middleware("auth:sanctum");
/* ************************************************************************************************************************************************ */
/* *************************************************************** Tags routes ************************************************************** */
Route::get("/v1/tags", [TagsController::class, "index"])->middleware("auth:sanctum");
Route::post("/v1/tag", [TagsController::class, "store"])->middleware("auth:sanctum");
Route::put("/v1/tag/{id}", [TagsController::class, "update"])->middleware("auth:sanctum");
Route::delete("/v1/tag/{id}", [TagsController::class, "destroy"])->middleware("auth:sanctum");
/* ************************************************************************************************************************************************ */

/* ***************************************************************** Roles routes ***************************************************************** */
Route::get("/v1/roles", [RoleController::class, "index"])->middleware("auth:sanctum");
Route::get("/v1/role/{role}", [RoleController::class, "show"])->middleware("auth:sanctum");
Route::post("/v1/role", [RoleController::class, "store"])->middleware("auth:sanctum");
Route::put("/v1/role/{role}", [RoleController::class, "update"])->middleware("auth:sanctum");
Route::delete("/v1/role/{role}", [RoleController::class, "destroy"])->middleware("auth:sanctum");
/* ************************************************************************************************************************************************ */

/* *************************************************************** Permission routes ************************************************************** */
Route::get("/v1/permissions", [PermissionController::class, "index"])->middleware("auth:sanctum");
Route::get("/v1/permission/{permission}", [PermissionController::class, "show"])->middleware("auth:sanctum");
Route::post("/v1/permission", [PermissionController::class, "store"])->middleware("auth:sanctum");
Route::put("/v1/permission/{permission}", [PermissionController::class, "update"])->middleware("auth:sanctum");
Route::delete("/v1/permission/{permission}", [PermissionController::class, "destroy"])->middleware("auth:sanctum");
/* ************************************************************************************************************************************************ */

/* *************************************************************** Categories routes ************************************************************** */
Route::get("/v1/categories", [CategoriesController::class, "index"])->middleware("auth:sanctum");
Route::post("/v1/category", [CategoriesController::class, "store"])->middleware("auth:sanctum");
Route::put("/v1/category/{id}", [CategoriesController::class, "update"])->middleware("auth:sanctum");
Route::delete("/v1/category/{id}", [CategoriesController::class, "destroy"])->middleware("auth:sanctum");
/* ************************************************************************************************************************************************ */

/* ***************************************************************** Image routes ***************************************************************** */
Route::get("/image/user/{filename}", [ImageController::class, "userImage"])->middleware("auth:sanctum");
Route::get("/image/recipe/{filename}", [ImageController::class, "recipeImage"])->middleware("auth:sanctum");
Route::get("/image/ingredient/{filename}", [ImageController::class, "ingredientImage"])->middleware("auth:sanctum");
/* ************************************************************************************************************************************************ */