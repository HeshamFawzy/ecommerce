@extends('admin.layouts.app')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Order Detail</h1>
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
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th scope="col">Name_en</th>
                                        <th scope="col">Name_ar</th>
                                        <th scope="col">Description_en</th>
                                        <th scope="col">Description_ar</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Color</th>
                                        <th scope="col">Size</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($orderProducts as $orderProduct)
                                        <tr>
                                            <td>{{ $orderProduct->productR->name_en }}</td>
                                            <td>{{ $orderProduct->productR->name_ar }}</td>
                                            <td>{{ $orderProduct->productR->description_en }}</td>
                                            <td>{{ $orderProduct->productR->description_ar }}</td>
                                            <td>{{ $orderProduct->quantity }}</td>
                                            <td>{{ $orderProduct->colorR->name }}</td>
                                            <td>{{ $orderProduct->sizeR->name }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
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
