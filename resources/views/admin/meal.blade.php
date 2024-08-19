@extends('admin.include.app')
@section('content')
    @include('admin.include.nav')
    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <div class="admin-meal">
        <h1>All meal :</h1>
        <div class="text-center">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-success m-2" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                Add a new meal
            </button>
            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Add a new meal</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{route('admin.meal.store')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label"> name :</label>
                                    <input type="text" class="form-control" name="meals_name" id="exampleFormControlInput1">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlTextarea1" class="form-label"> descrption :</label>
                                    <textarea class="form-control" name="meals_descrption" id="exampleFormControlTextarea1" rows="3"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label"> image :</label>
                                    <input type="file" class="form-control" name="meals_image" id="exampleFormControlInput1">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Meals Pattern :</label>
                                    <select class="form-select" name="meals_pattern" aria-label="Default select example">
                                        <option value="Pastries">Pastries</option>
                                        <option value="Meal">Meal</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">catgoryies :</label>
                                    <select class="form-select" name="catgories_id" aria-label="Default select example">
                                        @foreach ( $catgories as $catgory)
                                            <option value="{{$catgory->id}}">{{$catgory->catgories_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label"> Size :</label>
                                    <input type="text" class="form-control" name="Detail_size" id="exampleFormControlInput1">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label"> Price :</label>
                                    <input type="text" class="form-control" name="Detail_price" id="exampleFormControlInput1">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label"> Weight :</label>
                                    <input type="text" class="form-control" name="Detail_weight" id="exampleFormControlInput1">
                                </div>
                                <div class="mb-3">
                                    <button class="btn btn-success">insert</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <button type="button" class="btn btn-info m-2" data-bs-toggle="modal" data-bs-target="#staticBackdrop1">
                a detailes of meal already inserted
            </button>
            <div class="modal fade" id="staticBackdrop1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                aria-labelledby="staticBackdrop1Label" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdrop1Labe">Add a New detailes of meal
                            </h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{route('admin.mealdetail.store')}}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Meal name:</label>
                                    <select class="form-select" name="meals_id" aria-label="Default select example">
                                        @foreach ($meals as $meal)
                                            <option value="{{$meal->id}}">{{$meal->meals_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label"> a new Size :</label>
                                    <input type="text" name="Detail_size" class="form-control" id="exampleFormControlInput1">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label"> a new Weight :</label>
                                    <input type="text" name="Detail_weight" class="form-control" id="exampleFormControlInput1">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label"> a new Price :</label>
                                    <input type="text" name="Detail_price" class="form-control" id="exampleFormControlInput1">
                                </div>
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-success">insert</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
            <!-- table -->
            <div class="container text-center">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Image</th>
                            <th scope="col">Name</th>
                            <th scope="col">Descrption</th>
                            <th class="col no-mobile" scope="col">Size</th>
                            <th class="col no-mobile" scope="col">Price</th>
                            <th class="col no-mobile" scope="col">Weight</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($Details as $Detail )
                            <tr>
                                <th scope="row"><img src="{{ asset('storage/meals/'.$Detail->meal->meals_image) }}" height="50"/></th>
                                <td>{{$Detail->meal->meals_name}}</td>
                                <td>{{$Detail->meal->meals_descrption}}</td>
                                <td class="no-mobile">{{$Detail->Detail_size}}</td>
                                <td class="no-mobile">{{$Detail->Detail_price}} </td>
                                <td class="no-mobile">{{$Detail->Detail_weight}}</td>
                                <td>
                                    <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#UpdateMeal{{$Detail->id}}">
                                        Updete
                                    </button>
                                    <!-- Modal -->
                                    <div class="modal fade" id="UpdateMeal{{$Detail->id}}" data-bs-backdrop="static"
                                        data-bs-keyboard="false" tabindex="-1" aria-labelledby="UpdateMealLabel{{$Detail->id}}"
                                        aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="UpdateMealLabel{{$Detail->id}}">Update a new
                                                       meal</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{route('admin.meal.update',$Detail->id)}}" method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="mb-3">
                                                            <label for="exampleFormControlInput1" class="form-label"> name :</label>
                                                            <input type="text" class="form-control" value="{{$Detail->meal->meals_name}}" name="meals_name" id="exampleFormControlInput1">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="exampleFormControlTextarea1" class="form-label"> descrption :</label>
                                                            <input type="text" class="form-control" value="{{$Detail->meal->meals_descrption}}" name="meals_descrption" id="exampleFormControlInput1">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="exampleFormControlInput1" class="form-label"> image :</label>
                                                            <input type="file" class="form-control" name="meals_image" id="exampleFormControlInput1">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="exampleFormControlInput1" class="form-label">Meals Pattern :</label>
                                                            <select class="form-select" name="meals_pattern" aria-label="Default select example">
                                                                <option value="Pastries" {{ $Detail->meal->meals_pattern == 'Pastries' ? 'selected' : '' }}>Pastries</option>
                                                                <option value="Meal" {{ $Detail->meal->meals_pattern == 'Meal' ? 'selected' : '' }}>Meal</option>
                                                            </select>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="exampleFormControlInput1" class="form-label">catgoryies :</label>
                                                            <select class="form-select" name="catgories_id" aria-label="Default select example">
                                                                @foreach ( $catgories as $catgory)
                                                                <option value="{{$catgory->id}}" {{ $Detail->meal->catgories_id == $catgory->id ? 'selected' : '' }}>
                                                                    {{$catgory->catgories_name}}
                                                                </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="exampleFormControlInput1" class="form-label"> Size :</label>
                                                            <input type="text" class="form-control" value="{{$Detail->Detail_size}}" name="Detail_size" id="exampleFormControlInput1">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="exampleFormControlInput1" class="form-label"> Price :</label>
                                                            <input type="text" class="form-control" value="{{$Detail->Detail_price}}" name="Detail_price" id="exampleFormControlInput1">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="exampleFormControlInput1" class="form-label"> Weight :</label>
                                                            <input type="text" class="form-control" value="{{$Detail->Detail_weight}}" name="Detail_weight" id="exampleFormControlInput1">
                                                        </div>
                                                        <div class="mb-3">
                                                            <button class="btn btn-success">Update</button>
                                                        </div>
                                                    </form>

                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#deletemeal{{$Detail->id}}">
                                        Delete
                                    </button>
                                    <!-- Modal -->
                                    <div class="modal fade" id="deletemeal{{$Detail->id}}" data-bs-backdrop="static"
                                        data-bs-keyboard="false" tabindex="-1" aria-labelledby="deletemealLabel{{$Detail->id}}"
                                        aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="deletemealLabel{{$Detail->id}}">Delete catgories
                                                    </h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Are You Sure </p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <form action="{{route('admin.meal.destroy',$Detail->id)}}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">Delete</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

    </div>
@endsection
