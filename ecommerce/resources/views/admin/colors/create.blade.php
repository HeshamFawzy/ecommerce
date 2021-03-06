@extends('admin.layouts.app')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">{{ __('colors.create-color') }}</h1>
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
                                    <h6>{{ __('colors.name') }}</h6>
                                    <form action="{{ route('colors.store') }}" method="POST"
                                          enctype="multipart/form-data">
                                        @csrf
                                        <input type="text" class="form-control" placeholder="Please Enter a Color Name"
                                               name="colorName" required>
                                        <h6>{{ __('colors.name_ar') }}</h6>
                                        <input type="text" class="form-control"
                                               placeholder="Please Enter a Color Name In Arabic"
                                               name="colorName_ar" required>
                                        <button type="submit" class="btn btn-success float-right mt-3"><span
                                                class="fas fa-plus"></span>
                                        </button>
                                    </form>
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
