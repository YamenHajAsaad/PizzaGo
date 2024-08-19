@include('user.include.app')

@include('user.include.nav')

 <!-- order start -->
    <div class="order">
        @if (session('message'))
            <div class="alert alert-danger text-center mt-5" role="alert">
                {{ session('message') }}
            </div>
        @endif
        <h1>Your Order :</h1>
        <section class="h-100 gradient-custom">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-lg-10 col-xl-8">
                <div class="card" style="border-radius: 10px;">
                <div class="card-header px-4 py-4">
                    <h5 class="text-muted mb-0">Thanks for your Order : <span style="color: #A4161A;">{{Auth::user()->name}}</span></h5>
                </div>
                <div class="card-body p-4">
                    @php
                        $checkoutButton = '';
                        $cancelButton = '';

                    @endphp
                    @forelse($order as $item)
                        <div class="card shadow-0 border mb-4">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-2">
                                        <img src="{{ asset('storage/meals/'.$item['meal_image']) }}" class="img-fluid" alt="Meal Image">
                                    </div>
                                    <div class="col-md-2 text-center d-flex justify-content-center align-items-center">
                                        <p class="text-muted mb-0">{{ $item['meal_name'] }}</p>
                                    </div>
                                    <div class="col-md-2 text-center d-flex justify-content-center align-items-center">
                                        <p class="text-muted mb-0 small">Price: {{ $item['Detail_price'] }} l.t</p>
                                    </div>
                                    <div class="col-md-2 text-center d-flex justify-content-center align-items-center">
                                        <p class="text-muted mb-0 small">Size : {{ $item['Detail_size'] }}</p>
                                    </div>
                                    <div class="col-md-2 text-center justify-content-center align-items-center mt-2">
                                        <form action='{{route('user.update.quantity')}}' method='POST'>
                                            @csrf
                                            <input class='text-center iquantity' name='quantity' onchange='this.form.submit();' type='number' value='{{$item['meal_quntity']}}' min='1' max='10' onkeydown="javascript: return event.keyCode == 38 || event.keyCode == 40 ? true : false;">
                                            <input type='hidden' name='item_index' value='{{ $loop->index }}'> <!-- تمرير ال index بشكل صحيح -->
                                        </form>
                                    </div>
                                    <div class="col-md-2 text-center justify-content-center align-items-center mt-2">
                                        <form method="post" action="{{ route('user.session.destroyitem') }}">
                                            @csrf
                                            <input type="hidden" name="item_index" value="{{ $loop->index }}">
                                            <button type="submit" class="btn btn-danger">cancel</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @php
                            if ($loop->first) {
                                $checkoutButton = '<a href=" ' .route('user.confirm'). '" class="btn btn-success m-2">Check out</a>';
                                $cancelButton = '<a href="' . route('user.session.destroyall') . '" class="btn btn-danger m-2">Cancel all</a>';

                            }
                        @endphp
                    @empty
                        <p>No items added to the order.</p>
                    @endforelse
                    <div class="text-center">
                        <p class="text-muted mb-2"><span class="fw-bold me-4">Total:</span>{{$item['total']}} l.t</p>
                        <p class="text-muted mb-2"><span class="fw-bold me-4">Phone:</span> {{Auth::user()->phone_number}}</p>
                        <p class="text-muted mb-2"><span class="fw-bold me-4">* Please verify the phone number. The request will be rejected if there is no response *</span></p>
                    </div>
                </div>
                <div class="card-footer border-0 px-4 py-4"
                    style="background-color: #A4161A; border-bottom-left-radius: 10px; border-bottom-right-radius: 10px;">
                    <div class="d-flex p-3">
                        {!! $checkoutButton !!}
                        {!! $cancelButton !!}
                    </div>
                </div>

            </div>
            </div>
        </div>
        </section>
    </div>

  <!-- end  -->

  @include('user.include.footer')


