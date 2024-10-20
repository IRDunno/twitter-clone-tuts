<?php

namespace App\Http\Controllers;

use App\Models\Idea;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class DashboardController extends Controller {

  public function index() {
    $ideas = Idea::when(request()->has("search"), function (Builder $query) {
      $query->search(request("search", ""));
    })
      ->orderBy("created_at", "DESC")
      ->paginate(5);

    return view("dashboard", [
      "ideas" => $ideas,
    ]);
  }
}
