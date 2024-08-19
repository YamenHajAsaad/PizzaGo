@extends('admin.include.app')
@section('content')
    @include('admin.include.nav')
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
    <div class="order mt-4">
        <h1> Order History :</h1>
        @forelse ( $orders as $order)
            <section class="h-100 gradient-custom">
                <div class="container py-5 h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-lg-10 col-xl-8">
                    <div class="card" style="border-radius: 10px;">
                        <div class="card-body p-4">
                        @foreach($order->orderDetails as $detail)
                            <div class="card shadow-0 border mb-4">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-2">
                                        <img src="{{asset('storage/meals/'.$detail->meal->meals_image)}}"
                                            class="img-fluid" alt="Phone">
                                        </div>
                                        <div class="col-md-2 text-center d-flex justify-content-center align-items-center">
                                        <p class="text-muted mb-0">{{$detail->meal->meals_name}}</p>
                                        </div>
                                        <div class="col-md-2 text-center d-flex justify-content-center align-items-center">
                                        <p class="text-muted mb-0 small">size : {{$detail->detail->Detail_size}}</p>
                                        </div>
                                        <div class="col-md-2 text-center d-flex justify-content-center align-items-center">
                                        <p class="text-muted mb-0 small">price: {{$detail->detail->Detail_price}} l.t</p>
                                        </div>
                                        <div class="col-md-2 text-center  d-flex justify-content-center align-items-center mt-2">
                                        <p class="text-muted mb-0 small">Quntity : {{$detail->quantity}}</p>

                                        </div>
                                        <div class="col-md-2 text-center justify-content-center align-items-center mt-2">
                                        <p class="text-muted mb-0 small">Price All: </p>
                                        <input type="text" style="width: 70px" value="{{$detail->price_all}} l.t" disabled>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <div class="text-center">
                            <p class="text-muted mb-2"><span class="fw-bold me-4">Total:</span> {{$order->total}} l.t</p>
                            <p class="text-muted mb-2"><span class="fw-bold me-4">User Name:</span> {{$order->user->name}}</p>
                            <p class="text-muted mb-2"><span class="fw-bold me-4">Phone:</span>{{$order->user->phone_number}}</p>
                        </div>
                        </div>
                        <div class="card-footer border-0 px-4 py-4"
                        style="background-color: #A4161A; border-bottom-left-radius: 10px; border-bottom-right-radius: 10px;">
                        <div class="p-3">
                            <p class="text-center mb-2 text-light"><span class="fw-bold me-4">Status :
                                @if($order->status == 0)
                                    Reject
                                @endif
                                @if ($order->status == 1)
                                    accept
                                @endif
                                @if ($order->status == 2)
                                    hanning
                                @endif
                            </span></p>
                            <form action="{{route('admin.order.destroy',$order->id)}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger m-2">Delete</button>
                            </form>
                        </div>
                    </div>
                    </div>
                </div>
                </div>
            </section>
            <hr>
        @empty
        <div class="text-center m-5 p-5">
            <p class="fs-2" style="color: white">No Order Now</p>
        </div>
        @endforelse


    </div>
@endsection
