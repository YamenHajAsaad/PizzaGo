@extends('user.include.app')

@section('content')

@include('user.include.nav')

 <!-- start most most_catgory -->
    <div class="most_catgory">
        @if (session('message'))
            <div class="alert alert-danger text-center mt-5" role="alert">
                {{ session('message') }}
            </div>
        @endif
        <h1>All Catgories :</h1>
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
                <div class="d-flex justify-content-center">
                    {{ $catgories->links() }}
                </div>
            </div>
        </div>
    </div>


<!-- end most_catgory -->

@include('user.include.footer')

@endsection
