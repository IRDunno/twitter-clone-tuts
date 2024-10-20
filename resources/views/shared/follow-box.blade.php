<div class="card mt-3">
  <div class="card-header pb-0 border-0">
    <h5 class="">Top Users</h5>
  </div>
  <div class="card-body">
    @foreach ($topUsers as $user)
      <div class="hstack gap-2 mb-3">
        <div class="avatar">
          <a href="{{ route("users.show", $user) }}">
            <img style="width: 50px" class="avatar-img rounded-circle" src="{{ $user->getImageURL() }}"
              alt="{{ $user->name }}">
          </a>
        </div>
        <div class="overflow-hidden">
          <a class="h6 mb-0" href="{{ route("users.show", $user) }}">{{ $user->name }}</a>
          <p class="mb-0 small text-truncate">{{ $user->email }}</p>
        </div>
        @auth
          @if (!Auth::user()->follows($user) && Auth::user()->isNot($user))
            <form action="{{ route("users.follow", $user->id) }}" method="post" class="ms-auto">
              @csrf
              <button class="btn btn-primary-soft rounded-circle icon-md" title="follow">
                <i class="fa-solid fa-plus">
                </i>
              </button>
            </form>
          @else
            <form action="{{ route("users.unfollow", $user->id) }}" method="post" class="ms-auto">
              @csrf
              <button class="btn btn-primary-soft rounded-circle icon-md" title="unfollow">
                <i class="fa-solid fa-minus">
                </i>
              </button>
            </form>
          @endif
        @endauth
      </div>
    @endforeach
  </div>
</div>
