@extends('admin.layouts.app')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Categories</h1>
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
                                <table class="table table-striped table-responsive">
                                    <thead>
                                    <tr>
                                        <th>#Id</th>
                                        <th>Name_en</th>
                                        <th>Name_ar</th>
                                        <th>Image</th>
                                        <th>Size Image</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($categories as $category)
                                        <tr>
                                            <td>
                                                <div>{{ $category->id }}</div>
                                            </td>
                                            <td>
                                                <div>{{ $category->name_en }}</div>
                                            </td>
                                            <td>
                                                <div>{{ $category->name_ar }}</div>
                                            </td>
                                            <td>
                                                @if ($category->image_filename == null)
                                                    <div class="col-3"><img width="100%"
                                                                            src="{{ url("assets/admin/images/Question_Mark.png") }}">
                                                    </div>
                                                @else
                                                    <div class="col-3"><img width="100%"
                                                                            src="{{ url("categories/images/{$category->image_filename}") }}">
                                                    </div>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($category->size_filename == null)
                                                    <div class="col-3"><img width="100%"
                                                                            src="{{ url("assets/admin/images/Question_Mark.png") }}">
                                                    </div>
                                                @else
                                                    <div class="col-3"><img width="100%"
                                                                            src="{{ url("categories/sizeImages/{$category->size_filename}") }}">
                                                    </div>
                                            @endif
                                            <td>
                                                <div>
                                                    <a class="btn btn-warning"
                                                       href="{{ route('categories.edit' , $category) }}">Edit</a>
                                                    <form method="POST"
                                                          action="{{ route('categories.destroy' , $category->id) }}"
                                                          enctype="multipart/form-data>">
                                                        @method('delete')
                                                        @csrf
                                                        <button type="submit" class="btn btn-danger">Delete
                                                        </button>
                                                    </form>
                                                </div>

                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                {!! $categories->render() !!}
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
