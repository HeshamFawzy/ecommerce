@extends('admin.layouts.app')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Create Slider</h1>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li class="text text-danger">{{ $error }}</li>
                            @endforeach
                        </ul>
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
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <h3>Upload Image :</h3>
                                        </div>
                                        <form class="col-8" method="POST" action="{{ route('public.sliderUpload') }}"
                                              enctype="multipart/form-data">
                                            @csrf
                                            <div class="col-12">
                                                <input name="image" type="file" class="form-control-file" required>
                                                <button type="submit" class="btn btn-success float-right">Upload
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                    <h1>Slider Images :</h1>
                                    <table class="table table-bordered table-light">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Image</th>
                                            <th>Delete</th>
                                        </tr>
                                        </thead>

                                        <tbody>
                                        @foreach ($images as $image)
                                            <tr>
                                                <td>{{ $image->id }}</td>
                                                <td>
                                                    <div class="col-3 card card-dark">
                                                        <img style="width: 100%"
                                                             src="{{ url("sliders/{$image->image_filename}") }}">
                                                    </div>
                                                </td>
                                                <td>
                                                    <a class="btn btn-danger"
                                                       href="{{ route('public.sliderDelete' , $image->id) }}">Delete</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
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

