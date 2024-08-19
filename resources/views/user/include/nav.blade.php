<nav class="navbar navbar-expand-lg navbar-light fixed-top">
    <div class="container-fluid">
      <a class="navbar-brand" href="{{route('user.home')}}">Pizza Go!!</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll"
        aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarScroll">
        <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll">
          <li class="nav-item active">
            <a class="nav-link" aria-current="page" href="{{route('user.home')}}">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('user.catgory')}}">Catgories</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('user.pastries')}}">Pastries</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('user.meals')}}">Meal</a>
          </li>
          @guest
          @if (Route::has('login'))
              <li class="nav-item">
                  <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
              </li>
          @endif

          @if (Route::has('register'))
            <li class="nav-item">
                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
            </li>
          @endif
          @else
            <li class="nav-item">
                <a class="nav-link" href="{{route('user.order')}}">order</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('user.favorite')}}">favorite</a>
            </li>
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }}
                    </a>

                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
          @endguest
        </ul>
        <form class="d-flex">
          <input class="form-control me-2" type="search" placeholder="Search any Pizza !!" aria-label="Search">
          <button class="btn btn-outline-info" type="submit">Search</button>
        </form>
      </div>
    </div>
</nav>
