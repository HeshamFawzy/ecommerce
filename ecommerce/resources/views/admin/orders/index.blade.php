@extends('admin.layouts.app')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Orders</h1>
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
                                        <th scope="col">Code</th>
                                        <th scope="col">User</th>
                                        <th scope="col">Created At</th>
                                        <th scope="col">View Order Details</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($orders as $order)
                                        <tr>
                                            <td>{{ $order->code }}</td>
                                            <td>{{ $order->userR->email }}</td>
                                            <td>{{ $order->created_at }}</td>
                                            <td>
                                                <a class="btn btn-warning"
                                                   href="{{ route('orders.show' , $order->id ) }}">Show More
                                                    Order Details</a>
                                                @hasanyrole('Ordered|Chopping|Finishing|Delivered|Done' , 'admin')
                                                <a class="btn btn-success"
                                                   href="{{ route('orders.done' , $order->id ) }}">Done</a>
                                                @else
                                                    <p class="badge badge-info">{{$order->getStatus($order)}}</p>
                                                    @endhasanyrole
                                            </td>
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
