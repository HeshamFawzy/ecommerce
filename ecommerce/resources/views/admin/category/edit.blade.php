@extends('admin.layouts.app')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Edit Category</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('categories.update' , $category->id) }}" method="POST"
                                      enctype="multipart/form-data">
                                    @csrf
                                    @method('put')
                                    <div class="container">
                                        <div class="container" data-pg-collapsed>
                                            <div class="row">
                                                <p>Name (En) :</p>
                                            </div>
                                            <div class="col-12" data-pg-collapsed>
                                                <input type="text" class="form-control"
                                                       placeholder="Please Enter a Category Name in English"
                                                       name="name_en" required value="{{ $category->name_en }}">
                                            </div>
                                        </div>
                                        <div class="container" data-pg-collapsed>
                                            <div class="row">
                                                <p>Name (Ar) :</p>
                                            </div>
                                            <div class="col-12" data-pg-collapsed>
                                                <input type="text" class="form-control"
                                                       placeholder="Please Enter a Category Name in Arabic"
                                                       name="name_ar" required value="{{ $category->name_ar }}">
                                            </div>
                                        </div>
                                        <div class="container" data-pg-collapsed>
                                            <div class="row">
                                                <p>Category Image :</p>
                                            </div>
                                            <div class="row">
                                                <div class="col-6" data-pg-collapsed>
                                                    <input type="file" class="form-control"
                                                           placeholder="Please Enter a Category Image" id="uploadImage"
                                                           name="image">
                                                    @if ($category->image_filename == null)
                                                        <div class="col-3"><img width="100%"
                                                                                src="{{ url("assets/admin/images/Question_Mark.png") }}">
                                                        </div>
                                                    @else
                                                        <div class="col-3"><img width="100%"
                                                                                src="{{ url("categories/images/{$category->image_filename}") }}">
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="col-3 border">
                                                    <img id="image" alt="Uploaded Image" width="100%"
                                                         src="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="container" data-pg-collapsed>
                                            <div class="row">
                                                <p>Category SizeImage :</p>
                                            </div>
                                            <div class="row">
                                                <div class="col-6" data-pg-collapsed>
                                                    <input type="file" class="form-control"
                                                           placeholder="Please Enter a Category Size Image"
                                                           id="uploadSizeImage" name="sizeImage">
                                                    @if ($category->size_filename == null)
                                                        <div class="col-3"><img width="100%"
                                                                                src="{{ url("assets/admin/images/Question_Mark.png") }}">
                                                        </div>
                                                    @else
                                                        <div class="col-3"><img width="100%"
                                                                                src="{{ url("categories/sizeImages/{$category->size_filename}") }}">
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="col-3 border">
                                                    <img id="sizeImage" alt="Uploaded Image" width="100%"
                                                         src="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-warning float-right">Edit
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- /.col-md-6 -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
@endsection

@push('custom-foot')
    <script>
        $(function () {
            $('#uploadImage').change(function () {
                var input = this;
                var url = $(this).val();
                var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
                if (input.files && input.files[0] && (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg" || ext == "jfif")) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $('#image').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(input.files[0]);
                } else {
                    $('#image').attr('src', '/assets/admin/images/Question_Mark.png');
                }
            });
            $('#uploadSizeImage').change(function () {
                var input = this;
                var url = $(this).val();
                var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
                if (input.files && input.files[0] && (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg" || ext == "jfif")) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $('#sizeImage').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(input.files[0]);
                } else {
                    $('#sizeImage').attr('src', '/assets/admin/images/Question_Mark.png');
                }
            });
        });
    </script>
@endpush
