<div class="card">
  <div class="px-3 pt-4 pb-2">
    <div class="d-flex align-items-center justify-content-between">
      <div class="d-flex align-items-center">
        <img style="width:150px" class="me-3 avatar-sm rounded-circle"
          src="https://api.dicebear.com/6.x/fun-emoji/svg?seed={{ $user->name }}" alt="Mario Avatar">
        <div>
          @if ($editPage ?? false)
            <input value="{{ $user->name }}" type="text" class="form-control">
          @else
            <h3 class="card-title mb-0">
              <a href="#"> {{ $user->name }} </a>
            </h3>
            <span class="fs-6 text-muted">@ {{ $user->email }}</span>
          @endif
        </div>
      </div>
      @auth
        @if (Auth::id() === $user->id)
          <div>
            @if ($editPage ?? false)
            <a href="{{ route("users.show", $user->id) }}">View</a>
            @else
            <a href="{{ route("users.edit", $user->id) }}">Edit</a>
            @endif
          </div>
        @endif
      @endauth
    </div>
    <div class="px-2 mt-4">
      <h5 class="fs-5"> Bio : </h5>
      @if ($editPage ?? false)
        <textarea name="about" id="about" class="form-control">
        
      </textarea>
        <button class="btn btn-dark btn-small mb-3">Save</button>
      @else
        <p class="fs-6 fw-light">
          This book is a treatise on the theory of ethics, very popular during the
          Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes
          from a line in section 1.10.32.
        </p>
        <div class="d-flex justify-content-start">
          <a href="#" class="fw-light nav-link fs-6 me-3"> <span class="fas fa-user me-1">
            </span> 0 Followers </a>
          <a href="#" class="fw-light nav-link fs-6 me-3"> <span class="fas fa-brain me-1">
            </span> {{ $user->ideas()->count() }} </a>
          <a href="#" class="fw-light nav-link fs-6"> <span class="fas fa-comment me-1">
            </span> {{ $user->comments()->count() }} </a>
        </div>
      @endif
      @auth
        @if (Auth::id() !== $user->id)
          <div class="mt-3">
            <button class="btn btn-primary btn-sm"> Follow </button>
          </div>
        @endif
      @endauth
    </div>
  </div>
</div>

@if ($editPage ?? false)
@else
  <div>
    @forelse ($ideas as $idea)
      <div class="mt-3">
        @include("shared.idea-card")
      </div>
    @empty
      <p class="text-center my-3">No ideas found</p>
    @endforelse
  </div>
  <div class="mt-3">
    {{ $ideas->withQueryString()->links() }}
  </div>
@endif
