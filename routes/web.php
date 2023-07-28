<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::prefix("user")
    ->as("user.")
    ->controller(\App\Http\Controllers\Front\UserController::class)->group(function () {
        Route::get("/", "index")->name("index");
        Route::get("/create", "create")->name("create");
        Route::post("/create", "store")->name("create");
        Route::get("/{id}", "show")->name("show");
        Route::get("/edit/{id}", "edit")->name("edit");
        Route::post("/edit/{id}", "update")->name("edit");
        Route::get("/delete/{id}", "destroy")->name("delete");
    });
