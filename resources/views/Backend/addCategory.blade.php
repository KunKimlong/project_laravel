@extends('Backend.master')
@section('content')

    @section('site-title')
        Admin | Add Category
    @endsection
    @section('page-main-title')
        Add Category
    @endsection

    <!-- Content wrapper -->
    <div class="content-wrapper">

        @if (Session::has('success'))
                <script>
                    Swal.fire({
                        title: "Success",
                        text: "Category Add Success",
                        icon: "success"
                    });
                </script>
            @endif

            @if (Session::has('unsuccess'))
                <script>
                    Swal.fire({
                        title: "Faild",
                        text: "please fill category",
                        icon: "error"
                    });
                </script>
            @endif



        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="col-xl-12">
                <!-- File input -->
                <form action="/admin/add-category" method="post">
                    @csrf
                    <div class="card">
                        <div class="card-body"> 
                            <div class="row">
                                <div class="mb-3 col-12">
                                    <label for="formFile" class="form-label">Category</label>
                                    <input class="form-control" type="text" name="category" />
                                </div>
                            </div>
                            <div class="mb-3">
                                <input type="submit" class="btn btn-primary" value="Add Cateory">
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>

@endsection
