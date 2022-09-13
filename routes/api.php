<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\IngredientController;
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
/* ************************************************************************************************************************************************ */

/* *************************************************************** Ingredient routes ************************************************************** */
Route::get("/v1/ingredients", [IngredientController::class, "index"]);
Route::get("/v1/ingredients/{ingredients}", [IngredientController::class, "show"]);
Route::post("/v1/ingredients", [IngredientController::class, "store"]);
Route::put("/v1/ingredients/{id}", [IngredientController::class, "update"]);
Route::delete("/v1/ingredients/{id}", [IngredientController::class, "destroy"]);
/* ************************************************************************************************************************************************ */
/* *************************************************************** Tags routes ************************************************************** */
Route::get("/v1/tags", [TagsController::class, "index"]);
Route::post("/v1/tags", [TagsController::class, "store"]);
Route::put("/v1/tags/{id}", [TagsController::class, "update"]);
Route::delete("/v1/tags/{id}", [TagsController::class, "destroy"]);
/* ************************************************************************************************************************************************ */

/* ***************************************************************** Roles routes ***************************************************************** */
Route::get("/v1/roles", [RoleController::class, "index"]);
Route::get("/v1/roles", [RoleController::class, "index"]);
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