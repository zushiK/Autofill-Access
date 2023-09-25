<?php

use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
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

Route::get('/', [\App\Http\Controllers\Front\DashboardController::class, 'index'])->name('dashboard.index');

// Route::controller(\App\Http\Controllers\Auth\AuthController::class)
//     ->group(function () {
//         Route::get("login",  "login")->name("login");
//         Route::get("loout",  "logout")->name("logout");
//     });

/**
 * ソーシャルログイン
 */
// Route::prefix("/auth/{provider}")->group(function () {
//     Route::get("redirect", function ($provider) {
//         return Socialite::driver($provider)->with(['prompt' => 'consent'])->redirect();
//     })->where('provider', implode("|", config("services.allow_socialite_list")))->name("login.social");
//     Route::get(
//         'callback',
//         [\App\Http\Controllers\Auth\SocialiteController::class, "callback"]
//     )->where('provider', implode("|", config("services.allow_socialite_list")));
// });


// Route::middleware("auth")->group(function () {
//     Route::view("dashboard", "front.dashboard")->name("dashboard");
// });

// Route::prefix("user")->as("user.")
// ->controller(\App\Http\Controllers\Front\UserController::class)->group(function () {
//     Route::get("/", "index")->name("index");
//     Route::get("/create", "create")->name("create");
//     Route::post("/create", "store")->name("create");
//     Route::get("/{id}", "show")->name("show");
//     Route::get("/edit/{id}", "edit")->name("edit");
//     Route::post("/edit/{id}", "update")->name("edit");
//     Route::get("/delete/{id}", "destroy")->name("delete");
// });
