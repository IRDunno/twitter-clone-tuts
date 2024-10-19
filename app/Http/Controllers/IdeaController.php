<?php

namespace App\Http\Controllers;

use App\Models\Idea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class IdeaController extends Controller {

  public function show(Idea $idea) {
    return view("ideas.show", compact("idea"));
  }

  public function store() {
    $validated = request()->validate([
      "content" => "required|min:3|max:240"
    ]);

    $validated["user_id"] = Auth::id();

    Idea::create($validated);

    return redirect()->route("dashboard")->with("success", "Idea created successfully");
  }

  public function destroy(Idea $idea) {
    if (!Gate::allows("idea.delete", $idea)) {
      abort(403);
    }

    $idea->delete();

    return redirect()->route("dashboard")->with("success", "Idea deleted successfully");
  }

  public function edit(Idea $idea) {
    if (!Gate::allows("idea.edit", $idea)) {
      abort(403);
    }

    $editPage = true;
    return view("ideas.show", compact("idea", "editPage"));
  }

  public function update(Idea $idea) {
    if (!Gate::allows("idea.edit", $idea)) {
      abort(403);
    }

    $validated = request()->validate([
      "content" => "required|min:3|max:240"
    ]);

    $idea->update($validated);

    return redirect()->route("ideas.show", $idea->id)->with("success", "Idea updated successfully");
  }
}
