@extends('user.include.app')

@section('content')

@include('user.include.nav')
    <div class="most_product">
        @if (session('message'))
            <div class="alert alert-danger text-center" role="alert">
                {{ session('message') }}
            </div>
        @endif
        <h1>All Pastries in catgory :</h1>
        <p>The most popular and best-selling pizza products</p>
        <div class="container">
            <div class="row">
                @foreach ( $meals as $meal )
                    <div class="col-sm-12 col-md-6 col-lg-4 mb-3">
                        <div class="card">
                            <img src="{{asset('storage/meals/'.$meal->meals_image)}}" class="card-img-top" alt="...">
                            <div class="card-body">
                            <h5 class="card-title text-center">{{$meal->meals_name}}</h5>
                            <p class="card-text"> {{$meal->meals_descrption}}</p>
                            @auth
                                <p class="card-text"> size : </p>
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
                                <div class="text-center">
                                    <a href="{{route('user.favorite.store',$meal->id)}}" type="button" class="btn btn-outline-success">Add In Favorite</a>
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
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@include('user.include.footer')

@endsection
