<?php

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FeedController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\IdeaController;
use App\Http\Controllers\IdeaLikeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


// The name() function references the url (/url) ONLY, the method (POST, GET, etc) is not referenced
// So if you two with the same url, the name will depend on the method you send, the default being GET

Route::get("/", [DashboardController::class, "index"])->name("dashboard");

Route::resource("ideas", IdeaController::class)->except(["index", "create", "show"])->middleware("auth"); // create everything except those referenced, and add auth to them

Route::resource("ideas", IdeaController::class)->only(["show"]); // only create show without auth

Route::resource("ideas.comments", CommentController::class)->only(["store"])->middleware("auth");

Route::resource("users", UserController::class)->only(["show"]);
Route::resource("users", UserController::class)->only(["edit", "update"])->middleware("auth");

Route::get("/profile", [UserController::class, "profile"])->middleware("auth")->name("profile");

Route::post("users/{user}/follow", [FollowerController::class, "follow"])->middleware("auth")->name("users.follow");
Route::post("users/{user}/unfollow", [FollowerController::class, "unfollow"])->middleware("auth")->name("users.unfollow");

Route::post("ideas/{idea}/like", [IdeaLikeController::class, "like"])->middleware("auth")->name("ideas.like");
Route::post("ideas/{idea}/unlike", [IdeaLikeController::class, "unlike"])->middleware("auth")->name("ideas.unlike");

Route::get("/feed", FeedController::class)->middleware("auth")->name("feed");

Route::get("/admin", [AdminDashboardController::class, "index"])->middleware(["auth", "admin"])->name("admin.dashboard");
