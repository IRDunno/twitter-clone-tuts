<?php

namespace App\Http\Controllers;

use App\Models\Idea;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FeedController extends Controller {
  /**
   * Handle the incoming request.
   */
  public function __invoke(Request $request) {
    $followingIds = Auth::user()->followings()->pluck("user_id");

    $ideas = Idea::when(request()->has("search"), function (Builder $query) {
      $query->search(request("search", ""));
    })
      ->whereIn("user_id", $followingIds)
      ->latest();

    return view("dashboard", [
      "ideas" => $ideas->paginate(5)
    ]);
  }
}
