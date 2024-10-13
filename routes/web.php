<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\IdeaController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get("/", [DashboardController::class, "index"])->name("dashboard");

// The name() function references the url (/url) ONLY, the method (POST, GET, etc) is not referenced
// So if you two with the same url, the name will depend on the method you send, the default being GET
Route::get("/register", [AuthController::class, "register"])->name("register");
Route::post("/register", [AuthController::class, "store"]);
Route::get("/login", [AuthController::class, "login"])->name("login");
Route::post("/login", [AuthController::class, "authenticate"]);
Route::post("/logout", [AuthController::class, "logout"])->name("logout");

Route::get("/ideas/{idea}", [IdeaController::class, "show"])->name("ideas.show");
Route::post("/ideas", [IdeaController::class, "store"])->name("ideas.store")->middleware("auth");
Route::get("/ideas/{idea}/edit", [IdeaController::class, "edit"])->name("ideas.edit")->middleware("auth");
Route::put("/ideas/{idea}", [IdeaController::class, "update"])->name("ideas.update")->middleware("auth");
Route::delete("/ideas/{idea}", [IdeaController::class, "destroy"])->name("ideas.destroy")->middleware("auth");

Route::post("/ideas/{idea}/comments", [CommentController::class, "store"])->name("ideas.comments.store")->middleware("auth");
















Route::get("/terms", function () {
  return view("terms");
});
