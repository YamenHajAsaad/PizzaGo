<nav class="navbar navbar-expand-lg navbar-light">
    <div class="container-fluid">
      <a class="navbar-brand" href="{{route('admin.dashbord')}}">Control panel</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll"
        aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarScroll">
        <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll">
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="{{route('admin.dashbord')}}">Order now</a>
          </li>
          <li class="nav-item">
            <a class="nav-link"  href="{{route('admin.orderhistory')}}">Order history</a>
          </li>
          <li class="nav-item">
            <a class="nav-link"  href="{{route('admin.sales')}}">sales</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('admin.Catgories')}}">Catgories</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('admin.meal')}}">Meal</a>
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
        </ul>
        <form class="d-flex">
          <input class="form-control me-2" type="search" placeholder="Search any Pizza !!" aria-label="Search">
          <button class="btn btn-outline-info" type="submit">Search</button>
        </form>
      </div>
    </div>
  </nav>
