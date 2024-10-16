<div class="card">
  <div class="px-3 pt-4 pb-2">
    <form method="POST" enctype="multipart/form-data" action="{{ route("users.update", $user->id) }}">
      @csrf
      @method("put")
      <div class="d-flex align-items-center justify-content-between">
        <div class="d-flex align-items-center">
          <img style="width:150px" class="me-3 avatar-sm rounded-circle"
            src="{{ $user->getImageURL() }}" alt="{{ $user->name }}">
          <div>
            <input name="name" value="{{ $user->name }}" type="text" class="form-control">
            @error("name")
              <span class="text-danger fs-6">{{ $message }}</span>
            @enderror
          </div>
        </div>
        @auth
          @if (Auth::id() === $user->id)
            <div>
              <a href="{{ route("users.show", $user->id) }}">View</a>
            </div>
          @endif
        @endauth
      </div>
      <div class="mt-4">
        <label for="">Profile Picture</label>
        <input type="file" name="image" class="form-control">
      </div>
      <div class="px-2 mt-4">
        <h5 class="fs-5"> Bio : </h5>
        <textarea name="bio" id="bio" class="form-control">{{ $user->bio }}</textarea>
        @error("bio")
          <span class="text-danger fs-6">{{ $message }}</span>
        @enderror
        <button type="submit" class="btn btn-dark btn-small my-3 d-block">Save</button>
      </div>
    </form>
  </div>
</div>
