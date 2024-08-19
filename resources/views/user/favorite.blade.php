@extends('user.include.app')

@section('content')
@include('user.include.nav')

<div class="order">
    <h1>Your favorite :</h1>
    <section class="h-100 gradient-custom">
      <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
          <div class="col-lg-10 col-xl-8">
            <div class="card" style="border-radius: 10px;">
                <div class="card-body p-4">
                    @foreach ($meals as $meal)
                        <div class="card shadow-0 border mb-4">
                            <div class="card-body">
                            <div class="row">
                                <div class="col-md-2">
                                <img src="{{asset('storage/meals/'.$meal->meals_image)}}"
                                    class="img-fluid" alt="Phone">
                                </div>
                                <div class="col-md-2 text-center d-flex justify-content-center align-items-center">
                                    <p class="text-muted mb-0">{{$meal->meals_name}}</p>
                                </div>
                                <div class="col-md-4 text-center d-flex justify-content-center align-items-center">
                                    <p class="text-muted mb-0 small">descrption : {{$meal->meals_descrption}}</p>
                                </div>
                                <div class="col-md-2 text-center d-flex justify-content-center align-items-center mt-2">
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $meal->id }}">
                                        Delete
                                    </button>

                                    <div class="modal fade" id="deleteModal{{ $meal->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="deleteModalLabel{{ $meal->id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    <p>Are you sure you want to delete this meal? This action will delete meal in your favorite.</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <form action="{{route('user.favorite.destroy',$meal->id)}}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">Delete</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2 text-center d-flex justify-content-center align-items-center mt-2">
                                    <a href="{{route('user.favorite.show',$meal->id)}}" class="btn btn-success">show</a>
                                </div>
                            </div>
                            </div>
                        </div>
                    @endforeach
                </div>
          </div>
        </div>
      </div>
    </section>
</div>

@include('user.include.footer')
@endsection
