<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCommentRequest;
use App\Models\Comment;
use App\Models\Idea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller {
  public function store(CreateCommentRequest $request, Idea $idea) {
    $validated = $request->validated();

    $validated["idea_id"] = $idea->id;
    $validated["user_id"] = Auth::id();
    
    Comment::create($validated);

    return redirect()->route("ideas.show", $idea->id)->with("success", "Commented successfully");
  }
}
