@extends('backend.master')
@section('content')

    @section('site-title')
        Admin | Add Product
    @endsection
    @section('page-main-title')
        Add Product
    @endsection

    <!-- Content wrapper -->
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">

            @if (Session::has('unsuccess'))
                <script>
                    Swal.fire({
                        title: "Faild",
                        text: "please fill some column",
                        icon: "error"
                    });
                </script>
            @endif


            <div class="col-xl-12">
                <!-- File input -->
                <form action="/admin/update-product" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card">
                        <div class="card-body">

                            <div class="row">
                                <div class="mb-3 col-6">
                                    <input type="hidden" name="update_id" id="" value="{{$data->id}}">
                                    <label for="formFile" class="form-label">Name</label>
                                    <input class="form-control" type="text" name="name" value="{{$data->name}}"/>
                                </div>
                                <div class="mb-3 col-6">
                                    <label for="formFile" class="form-label">Quantity</label>
                                    <input class="form-control" type="text" name="qty" value="{{$data->stock_qty}}"/>
                                </div>
                                <div class="mb-3 col-6">
                                    <label for="formFile" class="form-label">Regular Price</label>
                                    <input class="form-control" type="number" value="{{$data->regular_price}}" name="regular_price" />
                                </div>
                                <div class="mb-3 col-6">
                                    <label for="formFile" class="form-label">Discount</label>
                                    <select name="discount" class="form-select">
                                        <option value="0" @if ($data->discount == 0)
                                            selected
                                        @endif>0</option>
                                        <option value="5" @if ($data->discount == 5)
                                            selected
                                        @endif>5 %</option>
                                        <option value="10" @if ($data->discount == 10)
                                            selected
                                        @endif>10 %</option>
                                        <option value="20" @if ($data->discount == 20)
                                            selected
                                        @endif>20 %</option>
                                    </select>
                                </div>
                                <div class="mb-3 col-6">
                                    <label for="formFile" class="form-label">Available Size</label>
                                    <select name="size[]" class="form-control size-color" multiple="multiple">
                                        <option value="S">S</option>
                                        <option value="M">M</option>
                                        <option value="L">L</option>
                                        <option value="XL">XL</option>
                                    </select>
                                </div>
                                <div class="mb-3 col-6">
                                    <label for="formFile" class="form-label">Available Color</label>
                                    <select name="color[]" class="form-control size-color" multiple="multiple">
                                        <option value="Red">Red</option>
                                        <option value="Blue">Blue</option>
                                        <option value="Grey">Grey</option>
                                        <option value="Grey">Yellow</option>
                                        <option value="Grey">Pink</option>
                                        <option value="Black">Black</option>
                                    </select>
                                </div>
                                <div class="mb-3 col-6">
                                    <label for="formFile" class="form-label">Category</label>
                                    <select name="category" class="form-control">
                                        @foreach ($category as $item)
                                            <option value="{{$item->id}}"@if ($data->category_id == $item->id)
                                                selected
                                            @endif
                                                >{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3 col-6">
                                    <label for="formFile" class="form-label text-danger">Recommend image size ..x.. pixels.</label>
                                    <input class="form-control" type="file" name="thumbnail" />
                                    <input type="hidden" name="old_thumbnail" id="" value="{{$data->thumbnail}}">
                                </div>
                                <div class="mb-3 col-12">
                                    <label for="formFile" class="form-label text-danger">Description</label>
                                    <textarea name="description" class="form-control" cols="30" rows="10">{{$data->description}}</textarea>
                                </div>
                            </div>
                            <div class="mb-3">
                                <input type="submit" class="btn btn-primary" value="Update Product">
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>

@endsection
