@extends('admin.include.app')
@section('content')
    @include('admin.include.nav')

    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <div class="admin-catgories">
        <h1>All Catgories :</h1>
        <div class="text-center mb-3">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                Add a new
            </button>
            <!-- Modal -->
            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Add a new catgories</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{route('admin.catgories.store')}}" method="Post" enctype="multipart/form-data">
                            @csrf
                            @method('POST')
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Catgories name :</label>
                                <input type="text" name="catgories_name" class="form-control" id="exampleFormControlInput1" required>
                                @error('catgories_name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Catgories descrption :</label>
                                <textarea class="form-control" name="catgories_descrption" id="exampleFormControlTextarea1" rows="3" required></textarea>
                                @error('catgories_descrption')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Catgories image :</label>
                                <input type="file" name="catgories_image" class="form-control" id="exampleFormControlInput1" required>
                                @error('catgories_image')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <button class="btn btn-success">insert</button>
                            </div>
                        </form>
                    </div>
                </div>
                </div>
            </div>
        </div>
        <div class="container text-center">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">Image</th>
                    <th scope="col">Name</th>
                    <th scope="col">Descrption</th>
                    <th scope="col">Actions</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($catgories as $catgory)
                        <tr>
                            <th scope="row"><img src="{{ asset('storage/catgories/'.$catgory->catgories_image) }}" height="50"/></th>
                            <td>{{ $catgory->catgories_name }}</td>
                            <td>{{ $catgory->catgories_descrption }}</td>
                            <td>
                                <div>
                                    <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#updateModal{{$catgory->id}}">
                                        update
                                    </button>
                                    <!-- Modal -->
                                    <div class="modal fade" id="updateModal{{$catgory->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="updateModalLabel{{$catgory->id}}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="updateModalLabel{{$catgory->id}}">update</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('update.catgory', $catgory->id) }}" method="POST" enctype="multipart/form-data"> <!-- تأكد من تعديل الـ route بشكل صحيح -->
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="mb-3">
                                                            <label for="catgoryName" class="form-label">catgory name:</label>
                                                            <input type="text" class="form-control" id="catgories_name" name="catgories_name" value="{{$catgory->catgories_name}}">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="catgoryDescription" class="form-label">catgory descrption :</label>
                                                            <textarea class="form-control" id="catgories_descrption" name="catgories_descrption" rows="3">{{$catgory->catgories_descrption}}</textarea>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="catgoryImage" class="form-label"> catgory image:</label>
                                                            <input type="file" class="form-control" id="catgories_image" name="catgories_image">
                                                        </div>
                                                        <div class="mb-3">
                                                            <button type="submit" class="btn btn-success">update</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $catgory->id }}">
                                        Delete
                                    </button>
                                    <div class="modal fade" id="deleteModal{{ $catgory->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="deleteModalLabel{{ $catgory->id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="deleteModalLabel{{ $catgory->id }}">Delete Category</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Are you sure you want to delete this category? This action will delete all associated products.</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <form action="{{route('admin.catgories.destroy', $catgory->id)}}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">Delete</button>
                                                    </form>
                                                </div>
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
