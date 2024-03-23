@extends('Backend.master')
@section('content')

    @section('site-title')
        Admin | Update Category
    @endsection
    @section('page-main-title')
        Update Category
    @endsection

    <!-- Content wrapper -->
    <div class="content-wrapper">
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
                <form action="/admin/update-category" method="post">
                    @csrf
                    <div class="card">
                        <div class="card-body"> 
                            <div class="row">
                                <div class="mb-3 col-12">
                                    <input type="text" name="update_id" value="{{$data->id}}" id="">
                                    <label for="formFile" class="form-label">Category</label>
                                    <input class="form-control" value="{{$data->name}}" type="text" name="category" />
                                </div>
                            </div>
                            <div class="mb-3">
                                <input type="submit" class="btn btn-primary" value="Update Cateory">
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>

@endsection
