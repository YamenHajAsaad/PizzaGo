@extends('admin.include.app')
@section('content')
    @include('admin.include.nav')
    <div class="sales">
        <h1>Sales arrangement :</h1>
        <div class="container">
            <div class="row">
                @foreach ( $meals as $meal)
                    <div class="col-sm-12 col-md-6 col-lg-4 mb-5">
                        <div class="card">
                            <img src="{{asset('storage/meals/'.$meal->meals_image)}}" class="card-img-top" alt="...">
                            <div class="card-body text-center">
                            <h5 class="card-title text-center">{{$meal->meals_name}}</h5>
                            <p class="card-text"> sales count : {{  $meal->orderDetails->count() }}</p>
                            <p class="card-text"> Total with quantity : {{$meal->total_quantity }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <hr>

    <div class="admin-sales">
        <h1>Table Of orders :</h1>
        <div class="container text-center mt-5">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">History</th>
                    <th scope="col">Count of orders</th>
                    <th scope="col">total</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr>
                                <th scope="row">{{$order->order_date}}</th>
                                <td>{{$order->total_orders}}</td>
                                <td>{{$order->total_revenue}}</td>

                        </tr>
                     @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
