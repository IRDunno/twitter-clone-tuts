<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\IdeaController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


// The name() function references the url (/url) ONLY, the method (POST, GET, etc) is not referenced
// So if you two with the same url, the name will depend on the method you send, the default being GET

Route::get("/", [DashboardController::class, "index"])->name("dashboard");

Route::group(["prefix" => "ideas/", "as" => "ideas."], function () {
  Route::get("{idea}", [IdeaController::class, "show"])->name("show");

  Route::group(["middleware" => ["auth"]], function () {
    Route::post("", [IdeaController::class, "store"])->name("store");
    Route::get("{idea}/edit", [IdeaController::class, "edit"])->name("edit");
    Route::put("{idea}", [IdeaController::class, "update"])->name("update");
    Route::delete("{idea}", [IdeaController::class, "destroy"])->name("destroy");

    Route::post("{idea}/comments", [CommentController::class, "store"])->name("comments.store");
  });
});
