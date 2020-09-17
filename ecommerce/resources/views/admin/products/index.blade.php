@extends('admin.layouts.app')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Products</h1>
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
                                        <th>Category Name</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if ($products ?? "")
                                        @foreach ($products as $product)
                                            <tr>
                                                <td>
                                                    <div>{{ $product->id }}</div>
                                                </td>
                                                <td>
                                                    <div>{{ $product->name_en }}</div>
                                                </td>
                                                <td>
                                                    <div>{{ $product->name_ar }}</div>
                                                </td>
                                                <td>
                                                    <div>{{ $product->categoryR->name_en }}
                                                        - {{ $product->categoryR->name_ar }}</div>
                                                </td>
                                                <td style="width: 25%">
                                                    <div>
                                                        <a class="btn btn-warning"
                                                           href="{{ route('products.show' , $product) }}">Show More
                                                            Details</a>
                                                        <a class="btn btn-warning"
                                                           href="{{ route('products.edit' , $product) }}">Edit</a>
                                                        <form class="" method="POST"
                                                              action="{{ route('products.destroy' , $product->id) }}"
                                                              enctype="multipart/form-data>">
                                                            @method('delete')
                                                            @csrf
                                                            <button type="submit" class="btn btn-danger mt-2">Delete
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                    </tbody>
                                </table>
                                {!! $products->render() !!}
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
