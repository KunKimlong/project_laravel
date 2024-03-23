@extends('Backend.master')
@section('content')

    @section('site-title')
        Admin | Update Logo
    @endsection
    @section('page-main-title')
        Update Logo
    @endsection

    <!-- Content wrapper -->
    <div class="content-wrapper">

        @if (Session::has('unsuccess'))
            <script>
                Swal.fire({
                    title: "Faild",
                    text: "please chosse logo",
                    icon: "error"
                });
            </script>
        @endif

        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="col-xl-12">
                <!-- File input -->
                <form action="/admin/update-logo" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card">
                        <div class="card-body"> 
                            <div class="row">
                                <div class="mb-3 col-12">
                                    <input type="hidden" name="update_id"  value="{{$data->id}}">
                                    <label for="formFile" class="form-label text-danger">Recommend image size ..x.. pixels.</label>
                                    <input class="form-control" type="file" name="thumbnail" />
                                </div>
                                <img src="{{url('Image/'.$data->thumbnail)}}" alt="" style="width:200px;">
                            </div>
                            <div class="mb-3 mt-3">
                                <input type="submit" class="btn btn-primary" value="Update Logo">
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>

@endsection
