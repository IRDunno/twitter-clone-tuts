<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\IdeaController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


// The name() function references the url (/url) ONLY, the method (POST, GET, etc) is not referenced
// So if you two with the same url, the name will depend on the method you send, the default being GET

Route::get("/", [DashboardController::class, "index"])->name("dashboard");

Route::resource("ideas", IdeaController::class)->except(["index", "create", "show"])->middleware("auth"); // create everything except those referenced, and add auth to them

Route::resource("ideas", IdeaController::class)->only(["show"]); // only create show without auth

Route::resource("ideas.comments", CommentController::class)->only(["store"])->middleware("auth");

Route::resource("users", UserController::class)->only(["show", "edit", "update"])->middleware("auth");