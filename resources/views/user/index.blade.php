@extends('user.include.app')

@section('content')

@include('user.include.nav')

  <!-- start leading page -->
    @if (session('message'))
        <div class="alert alert-danger text-center mt-5" role="alert">
            {{ session('message') }}
        </div>
    @endif
  <div class="leading_page">
    <div class="leading_text">
      <h1 class="text_large"> Pizza Go!! </h1>
      <p>
      <ul>
        <li>Best pastries</li>
        <li>Best Pizza</li>
        <li>Quality then quality</li>
        <li>Meal And pizza specialists</li>
      </ul>
      </p>
    </div>
    <div class="image-leading">
      <img src="{{asset('stytes/images/pizzaback.png')}}" class="rotating-image" />
    </div>
  </div>
  <div class="button_GO text-center">
    <a herf="#" type="button" class="btn btn-outline-light btn-rounded">Order NOW !!</a>
  </div>
  <!-- end leading page  -->
  <!-- start most Pastries -->

  <div class="most_catgory mt-0">
    <h1>MOST Catgories :</h1>
    <p>Varieties of Italian and American pizza products</p>
    <div class="container">
        <div class="row">
            @foreach ( $catgories as $catgory )
                <div class="col-sm-12 col-md-6 col-lg-4 mb-3">
                    <div class="card">
                        <img src="{{asset('storage/catgories/'.$catgory->catgories_image)}}" class="card-img-top" alt="...">
                        <div class="card-body text-center">
                        <p class="gatgory_name fw-bolder">{{$catgory->catgories_name}}</p>
                        <p class="card-text">{{$catgory->catgories_descrption}} </p>
                        <a href="{{route('user.show',$catgory->id)}}" type="button" class="btn btn-light">Show All</a>
                        </div>
                    </div>
                </div>
            @endforeach
            <div class="button_GO text-center">
                <a href="{{route('user.catgory')}}" type="button" class="btn btn-outline-light btn-rounded">ALL Catgories !!</a>
            </div>
        </div>
    </div>
  </div>

  <!-- end most Pastries -->
   <!-- start most product -->
  <div class="most_product mt-0">
    <h1>MOST Pastries :</h1>
    <p>The most popular and best-selling pizza products</p>
    <div class="container">
      <div class="row">
        @foreach ( $pastries as $pastry )
            <div class="col-sm-12 col-md-6 col-lg-4 mb-3">
                <div class="card">
                    <img src="{{asset('storage/meals/'.$pastry->meals_image)}}" class="card-img-top" alt="...">
                    <div class="card-body">
                    <h5 class="card-title text-center">{{$pastry->meals_name}}</h5>
                    <p class="card-text"> {{$pastry->meals_descrption}}</p>

                    @auth
                        <p class="card-text"> size : </p>
                        <form action="{{route('user.order.session')}}" method="POST">
                            @csrf
                            <div class="text-center m-3">
                                <select class="form-select" name="details_meal" aria-label="Default select example">
                                    @foreach ( $pastry->details as $detail )
                                        <option value="{{ $detail->id }}">{{ $detail->Detail_size }} : {{ $detail->Detail_weight }} : {{ $detail->Detail_price }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="text-center m-2">
                                <button type="submit" class="btn btn-danger">Add In Order</button>
                            </div>
                        </form>
                        <div class="text-center">
                            <a href="{{route('user.favorite.store',$pastry->id)}}" type="button" class="btn btn-outline-success">Add In Favorite</a>
                        </div>
                    @endauth
                    @guest
                        <div class="text-center m-3">
                            <a href="{{ route('login') }}" type="button" class="btn btn-success">Login For Detail</a>
                            <h5 style="color: white">OR</h5>
                            <a href="{{ route('register') }}" type="button" class="btn btn-primary">Regester For Detail</a>
                        </div>
                    @endguest
                    </div>
                </div>
            </div>
        @endforeach
        <div class="button_GO text-center">
          <a href="{{route('user.pastries')}}" type="button" class="btn btn-outline-light btn-rounded">ALL Pastries !!</a>
        </div>
      </div>
    </div>
  </div>
  <!-- end most product -->
  <!-- start meal  -->
  <div class="meal mt-0">
    <h1>MOST Meal :</h1>
    <p>Our meals are Italian and American</p>
    <div class="container">
      <div class="row mb-5">
        <!-- one meal -->
        @foreach ( $meals as $meal )
            <h2 class="text-center ">{{$meal->meals_name}}</h2>
            <div class="col-sm-12 col-md-6 col-lg-6 mb-4">
                <img src="{{asset('storage/meals/'.$meal->meals_image)}}">
            </div>
            <div class ="col-sm-12 col-md-12 col-lg-6 mt-3">
            <span class="text-center">{{$meal->meals_descrption}}</span>
            @auth
            <form action="{{route('user.order.session')}}" method="POST">
                @csrf
                <div class="text-center m-3">
                    <select class="form-select" name="details_meal" aria-label="Default select example">
                        @foreach ( $meal->details as $detail )
                            <option value="{{ $detail->id }}">{{ $detail->Detail_size }} : {{ $detail->Detail_weight }} : {{ $detail->Detail_price }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="text-center m-2">
                    <button type="submit" class="btn btn-danger">Add In Order</button>
                </div>
            </form>
                <div class="text-center m-4">
                    <a href="{{ route('user.favorite.store',['meal'=>$meal->id,'detail'=>$meal->details->first()->id]) }}" type="button" class="btn btn-success">Add In Favorite</a>
                </div>
            @endauth
            @guest
                <div class="text-center m-3">
                    <a href="{{ route('login') }}" type="button" class="btn btn-success">Login For Detail</a>
                    <h5>OR</h5>
                    <a href="{{ route('register') }}" type="button" class="btn btn-primary">Regester For Detail</a>
                </div>
            @endguest
            </div>
            <hr>
        @endforeach
        <!-- end one meal -->
      </div>
      <div class="button_GO text-center">
        <a href="{{route('user.meals')}}" type="button" class="btn btn-outline-light btn-rounded">ALL Meal !!</a>
      </div>
    </div>
  </div>
  <!-- end meal -->
@include('user.include.footer')

@endsection

