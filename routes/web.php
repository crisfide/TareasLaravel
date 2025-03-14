<?php

use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\TodosController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect("todos");
})->name("/");


//listado
Route::get('/todos', [TodosController::class,"index"])->name("todos");

//crear
Route::post('/todos', [TodosController::class,"store"])->name("todos");

Route::get('/todos/{id}', [TodosController::class,"show"])->name("todos-show");
Route::patch('/todos/{id}', [TodosController::class,"update"])->name("todos-update");
Route::delete('/todos/{id}', [TodosController::class,"destroy"])->name("todos-destroy");


//categories
//Route::resource('categories', CategoriesController::class);//->names('categories');
// Route::middleware(['web'])->group(function () {
//     Route::resource('categories', CategoriesController::class);
// });



Route::get('/categories', [CategoriesController::class,"index"])->name("categories");

Route::post('/categories', [CategoriesController::class,"store"])->name("categories");

Route::get('/categories/{id}', [CategoriesController::class,"show"])->name("categories-show");
Route::patch('/categories/{id}', [CategoriesController::class,"update"])->name("categories-update");
Route::delete('/categories/{id}', [CategoriesController::class,"destroy"])->name("categories-destroy");