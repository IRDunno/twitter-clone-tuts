<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateIdeaRequest;
use App\Http\Requests\UpdateIdeaRequest;
use App\Models\Idea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class IdeaController extends Controller {

  public function show(Idea $idea) {
    return view("ideas.show", compact("idea"));
  }

  public function store(CreateIdeaRequest $request) {
    $validated = $request->validated();

    $validated["user_id"] = Auth::id();

    Idea::create($validated);

    return redirect()->route("dashboard")->with("success", "Idea created successfully");
  }

  public function destroy(Idea $idea) {
    Gate::authorize("delete", $idea);

    $idea->delete();

    return redirect()->route("dashboard")->with("success", "Idea deleted successfully");
  }

  public function edit(Idea $idea) {
    Gate::authorize("update", $idea);

    $editPage = true;
    return view("ideas.show", compact("idea", "editPage"));
  }

  public function update(UpdateIdeaRequest $request, Idea $idea) {
    Gate::authorize("update", $idea);

    $validated = $request->validated();

    $idea->update($validated);

    return redirect()->route("ideas.show", $idea->id)->with("success", "Idea updated successfully");
  }
}
