@extends('admin.layouts.app')

@push('custom-head')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/lib/trix/trix.css') }}">
    <script type="text/javascript" src="{{ asset('assets/admin/lib/trix/trix.js') }}"></script>
@endpush
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Create About Us</h1>
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
                                <form method="POST" action="{{ route('public.aboutUpload') }}"
                                      enctype="multipart/form-data">
                                    @csrf
                                    <input id="about" type="hidden" name="about" required>
                                    <trix-editor input="about"></trix-editor>
                                    <button class="btn btn-success float-right m-2" type="submit">Save</button>
                                </form>
                                @if ($about ?? '')
                                    <div class="card card-blue p-2 m-1">
                                        <div class="trix-content">{!! $about->about !!}</div>
                                    </div>
                                @endif
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
        $('#summernote').summernote({
            placeholder: 'Hello Bootstrap 4',
            tabsize: 2,
            height: 100
        });
    </script>
@endpush

