<div class="card">
  <div class="px-3 pt-4 pb-2">
    <div class="d-flex align-items-center justify-content-between">
      <div class="d-flex align-items-center">
        <img style="width:50px; height:50px; object-fit:cover" class="me-2 avatar-sm rounded-circle"
          src="{{ $idea->user->getImageURL() }}" alt="{{ $idea->user->name }} ">
        <div>
          <h5 class="card-title mb-0">
            <a href="{{ route("users.show", $idea->user->id) }}"> {{ $idea->user->name }} </a>
          </h5>
        </div>
      </div>
      <form action="{{ route("ideas.destroy", $idea->id) }}" method="post">
        @method("delete")
        @csrf
        @if ($editPage ?? false || Request::is('/'))
          <a href="{{ route("ideas.show", $idea->id) }}">View</a>
        @else
          @if (Auth::id() === $idea->user_id)
            <a href="{{ route("ideas.edit", $idea->id) }}">Edit</a>
          @endif
        @endif
        @if (Auth::id() === $idea->user_id)
          <button class="ml-1 btn btn-danger btn-sm">X</button>
        @endif
      </form>
    </div>
  </div>
  <div class="card-body">
    @if ($editPage ?? false)
      <form action="{{ route("ideas.update", $idea->id) }}" method="post">
        @csrf
        @method("put")
        <div class="mb-3">
          <textarea class="form-control" id="content" name="content" rows="3">{{ $idea->content }}</textarea>
          @error("idea")
            <span class="d-block fs-6 text-danger mt-2">{{ $message }}</span>
          @enderror
        </div>
        <div class="">
          <button class="btn btn-dark btn-sm"> Save </button>
        </div>
      </form>
    @else
      <p class="fs-6 fw-light text-muted">
        {{ $idea->content }}
      </p>
      <div class="d-flex justify-content-between">
        <div>
          <a href="#" class="fw-light nav-link fs-6"> <span class="fas fa-heart me-1">
            </span> {{ $idea->likes }} </a>
        </div>
        <div>
          <span class="fs-6 fw-light text-muted"> <span class="fas fa-clock"> </span>
            {{ $idea->created_at }} </span>
        </div>
      </div>
      @include("shared.comments-box")
    @endif
  </div>
</div>
