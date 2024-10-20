<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller {
  public function show(User $user) {
    $ideas = $user->ideas()->paginate(5);

    return view("users.show", compact("user", "ideas"));

    // $imagePath = request()->file("image")->store("profile", "public");
  }

  public function edit(User $user) {
    Gate::authorize("update", $user);

    return view("users.edit", compact("user"));
  }

  public function update(User $user) {
    Gate::authorize("update", $user);

    $validated = request()->validate([
      "name" => "required|min:3|max:40",
      "bio" => "nullable|max:255",
      "image" => "image"
    ]);

    if (request("image")) {
      $imagePath = request()->file("image")->store("profile", "public");
      $validated["image"] = $imagePath;

      Storage::disk("public")->delete($user->image ?? "");
    }

    $user->update($validated);

    return redirect()->route("profile");
  }

  public function profile() {
    return $this->show(Auth::user());
  }
}
