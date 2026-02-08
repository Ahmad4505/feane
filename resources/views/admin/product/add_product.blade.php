@extends('admin.master')

@section('content')
    {{-- <h1 class="h3 mb-4 text-gray-800"></h1> --}}


    <div class="card shadow mb-4 ">

        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Add Product</h6>
        </div>
        <div class="card-body">

            <form action="{{ route('admin.product.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Product Name</label>
                    <input type="text"  id="exampleInputEmail1" placeholder="Product Name"
                        name="name"class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}">
                        @error('name')
                            <small class="invalid-feedback">{{ $message }}</small>
                        @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Price</label>
                    <input type="number" name="price" placeholder="Enter A Price" class="form-control @error('price') is-invalid @enderror" value="{{ old('price') }}">
                    @error('price')
                            <small class="invalid-feedback">{{ $message }}</small>
                        @enderror
                </div>

                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Description</label>
                    <textarea id="exampleFormControlTextarea1" rows="3" placeholder="Enter A Description" name="description" class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                @error('description')
                            <small class="invalid-feedback">{{ $message }}</small>
                        @enderror
                </div>

                <div class="input-group mb-3">
                    <label class="form-label">Category</label>
                    <select  id="inputGroupSelect01" style="height:45px ; width: 100%;"
                        name="category_id"  class="form-control @error('category_id') is-invalid @enderror">

                        <option value="" selected disabled>Choose An Category</option>

                        @foreach ($categories as $category)
                    <option value="{{ $category->id }}">
                        {{ $category->name }}
                    </option>
                    @endforeach
                    </select>
                    @error('category_id')
                            <small class="invalid-feedback">{{ $message }}</small>
                        @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label ">Image</label>
                    <input type="file" name="image" placeholder="Enter An Image" class="form-control @error('image') is-invalid @enderror" value="{{ old('image') }}">
                    @error('image')
                            <small class="invalid-feedback">{{ $message }}</small>
                        @enderror
                </div>

                <button type="submit" class="btn btn-success mt-4" style="width: 20%">Create</button>
            </form>
        </div>
    </div>
@endsection
