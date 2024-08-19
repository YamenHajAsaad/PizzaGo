@extends('user.include.app')

@section('content')

@include('user.include.nav')


    <div class="meal">
        @if (session('message'))
            <div class="alert alert-danger text-center mt-5" role="alert">
                {{ session('message') }}
            </div>
        @endif
        <h1>All Meal :</h1>
        <p>Our meals are Italian and American</p>
        <div class="container">
            <div class="row ">
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
                            <a href="{{ route('user.favorite.store',$meal->id) }}" type="button" class="btn btn-success">Add In Favorite</a>
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
                <div class="d-flex justify-content-center">
                    {{ $meals->links() }}
                </div>
                <!-- end one meal -->
            </div>
        </div>
    </div>
@include('user.include.footer')

@endsection
