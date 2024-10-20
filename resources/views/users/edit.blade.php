@extends("layout.layout")

@section("title", "Edit Profile")

@section("content")
  <div class="row">
    <div class="col-3">
      @include("shared.left-sidebar")
    </div>
    <div class="col-6">
      @include("shared.success-message")
      @include("users.shared.user-edit-card")
    </div>
    <div class="col-3">
      @include("shared.search-bar")
      @include("shared.follow-box")
    </div>
  </div>
@endsection
