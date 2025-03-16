<?php

use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\FbAuthController;
use App\Http\Controllers\GoogleAuthController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\TodosController;
use Illuminate\Support\Facades\Route;

Route::get('/', action: function () {
    return redirect("login");
})->name("/");


Route::get('/register', [RegisterController::class,"show"])->name("register");
Route::post('/register', [RegisterController::class,"register"])->name("register");

Route::get('/login', [LoginController::class,"show"])->name("login");
Route::post('/login', [LoginController::class,"login"])->name("login");

Route::get('/logout', [LoginController::class,"logout"])->name("logout");



/// toDos

//listado
Route::get('/todos', [TodosController::class,"index"])->name("todos");
//crear
Route::post('/todos', [TodosController::class,"store"])->name("todos");

Route::get('/todos/{id}', [TodosController::class,"show"])->name("todos-show");
Route::patch('/todos/{id}', [TodosController::class,"update"])->name("todos-update");
Route::delete('/todos/{id}', [TodosController::class,"destroy"])->name("todos-destroy");


///categories

//Route::resource('categories', CategoriesController::class);//->names('categories');
// Route::middleware(['web'])->group(function () {
//     Route::resource('categories', CategoriesController::class);
// });
Route::get('/categories', [CategoriesController::class,"index"])->name("categories");
//crear
Route::post('/categories', [CategoriesController::class,"store"])->name("categories");

Route::get('/categories/{id}', [CategoriesController::class,"show"])->name("categories-show");
Route::patch('/categories/{id}', [CategoriesController::class,"update"])->name("categories-update");
Route::delete('/categories/{id}', [CategoriesController::class,"destroy"])->name("categories-destroy");



Route::get('/g', [GoogleAuthController::class,"getAuthUrl"])->name("g");
Route::get("oauth2callback",[GoogleAuthController::class,"callback"])->name("googleCallback");

Route::get('/f', [FbAuthController::class,"getAuthUrl"])->name("f");
Route::get("/fbCallback",[FbAuthController::class,"callback"])->name("fbCallback");