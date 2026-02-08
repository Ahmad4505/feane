@extends('admin.master')

@section('content')
    {{-- <h1 class="h3 mb-4 text-gray-800">Add Category</h1> --}}

    <div class="card shadow mb-4 ">

        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Add Category</h6>
        </div>

        <div class="card-body">


            <form action="{{ route('admin.category.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Category Name</label>
                    <input type="text"  id="exampleInputEmail1" placeholder="Category Name"
                        name="name"class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}">
                        @error('name')
                            <small class="invalid-feedback">{{ $message }}</small>
                        @enderror
                </div>

                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Description</label>
                    <textarea id="exampleFormControlTextarea1" rows="3" placeholder="Enter A Description" name="description"
                        class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                    @error('description')
                        <small class="invalid-feedback">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Image</label>
                    <input type="file" name="image" placeholder="Enter An Image"
                        class="form-control @error('image') is-invalid @enderror" value="{{ old('image') }}">
                    @error('image')
                        <small class="invalid-feedback">{{ $message }}</small>
                    @enderror
                </div>

                <button type="submit" class="btn btn-success mt-5" style="width: 20%">Create</button>
            </form>
        </div>
    </div>
@endsection
