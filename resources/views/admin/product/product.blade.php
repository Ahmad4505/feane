@extends('admin.master')

@section('css')
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"> --}}

    <link href="{{ asset('adminassets/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <style>
        table td,
            table th {
                vertical-align: middle !important;
                text-align: center !important;
                align-items: center !important
            }

        table.dataTable td {
            white-space: normal !important;
        }

        .description-cell {
            max-width: 300px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
    </style>
@endsection

@section('content')
    {{-- <h1 class="h3 mb-4 text-gray-800">product</h1> --}}

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">All Products</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Description</th>
                            <th>Category</th>
                            <th>Image</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $pronum = ($products->currentPage() - 1) * $products->perPage() + 1;
                        @endphp
                        @if ($products->count() > 0)
                            @foreach ($products as $product)
                                <tr id="row_{{ $product->id }}">
                                    {{-- <td>{{  $product->id}}</td> --}}
                                    <td style="width: 30px">{{ $pronum++ }}</td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->price }} $</td>
                                    {{-- <td class="description-cell">{{ $product->description }}</td> --}}
                                    <td class="description-cell" title="{{ $product->description }}">
                                        {{ $product->description }}
                                    </td>
                                    <td>{{ $product->category->name ?? '-' }}</td>
                                    <td>
                                        <img src="{{ asset($product->image) }} " width="80px" height="60px">
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.product.show', $product->id) }}" class="btn btn-info"><i
                                                class="fas fa-eye"></i></a>

                                        <a onclick="editProduct(event)" data-bs-toggle="modal" data-bs-target="#EditProduct"
                                            data-name="{{ $product->name }}" data-price="{{ $product->price }}"
                                            data-description="{{ $product->description }}"
                                            data-category="{{ $product->category_id }}"
                                            data-image="{{ asset($product->image) }}"
                                            href="{{ route('admin.product.update', $product->id) }}"
                                            class="btn btn-primary">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        <form class="d-inline" action="{{ route('admin.product.destroy', $product->id) }}"
                                            method="POST">
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-danger "><i class="fas fa-trash"></i></button>
                                        </form>

                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="7" class="text-center">No Data Found</td>
                            </tr>
                        @endif

                    </tbody>
                </table>
                {{ $products->links() }}
            </div>
        </div>
    </div>



    <!-- Modal -->
    <div class="modal fade" id="EditProduct" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Product</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Product Name</label>
                            <input type="text" id="exampleInputEmail1" placeholder="Product Name"
                                name="name"class="form-control @error('name') is-invalid @enderror"
                                value="{{ old('name') }}">
                            @error('name')
                                <small class="invalid-feedback">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Price</label>
                            <input type="number" name="price" placeholder="Enter A Price"
                                class="form-control @error('price') is-invalid @enderror" value="{{ old('price') }}">
                            @error('price')
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

                        <div class="input-group mb-3">
                            <label class="form-label">Category</label>
                            <select id="inputGroupSelect01" style="height:45px ; width: 100%;" name="category_id"
                                class="form-control cat-select @error('category_id') is-invalid @enderror">

                                <option disabled selected id="cat">Choose A Category</option>

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
                            <input type="file" name="image" placeholder="Enter An Image"
                                class="form-control @error('image') is-invalid @enderror" value="{{ old('image') }}">
                            @error('image')
                                <small class="invalid-feedback">{{ $message }}</small>
                            @enderror
                            <img width="80px" src="" id="oldImage" alt="">
                        </div>
                        <button class="btn btn-info">Update Product</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('js')
    <!-- Page level plugins -->
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('adminassets/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('adminassets/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('adminassets/js/demo/datatables-demo.js') }}"></script>


    <script>
        @if (session('msg'))
            Swal.fire({
                title: "Good job!",
                text: "{{ session('msg') }}",
                icon: "{{ session('icon') }}"
            });
        @endif
    </script>

    <script>
        //get old data from rowes


        function editProduct(e) {
            let name = e.target.closest('a').dataset.name
            let price = e.target.closest('a').dataset.price
            let description = e.target.closest('a').dataset.description
            let category = e.target.closest('a').dataset.category
            let image = e.target.closest('a').dataset.image

            let url = e.target.closest('a').href

            //show old data in form

            document.querySelector('[name=name]').value = name
            document.querySelector('[name=price]').value = price
            document.querySelector('#exampleFormControlTextarea1').value = description
            document.querySelector('.cat-select').value = category
            document.querySelector('#oldImage').src = image

            //submit updated data to controller methode
            document.querySelector('.modal form').action = url

        }
    </script>
@endsection
