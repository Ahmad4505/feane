@extends('admin.master')

@section('css')
    <link href="{{ asset('adminassets/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">

    <style>
        @import url(https://fonts.googleapis.com/css?family=Raleway:400,300,500,700);

        * {
            box-sizing: border-box;
        }

        #content {
            position: relative;
            /* هذا يجعل أي absolute داخل هذا القسم يتحرك بناءً عليه */
        }

        body {

            background: #aedaa6;
            font-family: "Raleway";

            .card {

                width: 90%;
                height: 85%;
                position: absolute;
                background: white;
                margin: 0 auto;
                margin: 30px auto;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12);
                transition: all 0.3s;

                &:hover {

                    box-shadow: 0 8px 17px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);

                }

                .photo {

                    padding: 30px;
                    width: 45%;
                    text-align: center;
                    float: left;
                    position: relative;
                    top: 18%;
                    img {
                        max-height: 250px;

                    }

                }

                .description {

                    padding: 30px;
                    float: left;
                    width: 55%;
                    border-left: 2px solid #efefef;

                    h1 {
                        color: #515151;
                        font-weight: 300;
                        padding-top: 15px;
                        margin: 0;
                        font-size: 30px;
                        font-weight: 300;
                        position: absolute;
                        left: 55%;
                        top: 33%;
                    }

                    h2 {
                        color: #515151;
                        margin: 0;
                        text-transform: uppercase;
                        font-weight: 500;
                        position: absolute;
                        left: 55%;
                        top: 25%;
                    }

                    p {
                        font-size: 12px;
                        line-height: 20px;
                        color: #727272;
                        padding: 20px 0;
                        margin: 0;
                        position: absolute;
                        left: 55%;
                        right: 15%;
                        top: 43%;

                    }

                    .cbtn {
                        position: absolute;
                        left: 55%;
                        top: 60%;

                    }

                    .button {

                        outline: 0;
                        border: 0;
                        background: none;
                        border: 1px solid #d9d9d9;
                        padding: 8px 0px;
                        margin-bottom: 30px;
                        color: #515151;
                        text-transform: uppercase;
                        width: 125px;
                        font-family: inherit;
                        margin-right: 5px;
                        transition: all 0.3s ease;
                        font-weight: 500;


                        &:hover {

                            backeground: darken(white, 2%);
                            border: 1px solid #aedaa6;
                            color: #aedaa6;
                            cursor: pointer;

                        }

                    }

                }

            }

        }
    </style>
@endsection



@section('content')
    {{-- <h1 class="h3 mb-4 text-gray-800">product</h1> --}}

    {{-- <div class="card">
        <div class="card-body">

            <p><strong>image:</strong></p><img src="{{ $categorys->image }}" alt="">
            <p><strong>الاسم:</strong> {{ $categorys->name }}</p>
            <p><strong>الوصف:</strong> {{ $categorys->description }}</p>
        </div>
    </div> --}}

    <div class="card">

        <div class="photo">
            <img  src="{{ asset($category->image) }}">
        </div>
        <div class="description">
            <h2>{{ $category->name }}</h2>
            <h1>part {{ $category->products_count }}</h1>
            <p>{{ $category->description }}</p>
            <div class="cbtn">
                <a class="button btn btn-info" href="{{ route('admin.category.show') }}">backe</a>
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
    <script src="js/demo/datatables-demo.js"></script>
@endsection
