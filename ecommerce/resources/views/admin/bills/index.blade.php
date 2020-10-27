@extends('admin.layouts.app')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">{{ __('users.title') }}</h1>
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
                                <table class="table table-striped" id="Table">
                                    <thead>
                                    <tr>
                                        <th scope="col">{{ __('orders.order-code') }}</th>
                                        <th scope="col">{{ __('orders.order-user') }}</th>
                                        <th scope="col">{{ __('orders.order-phone') }}</th>
                                        <th scope="col">{{ __('orders.order-date') }}</th>
                                        <th scope="col"></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($orders as $order)
                                        <tr>
                                            <td>{{ $order->code }}</td>
                                            <td>{{ $order->userR->email }}</td>
                                            <td>{{ $order->userR->phoneNumber }}</td>
                                            <td>{{ date('d-m-Y h:m A', strtotime($order->created_at)) }}</td>
                                            <td>
                                                <a class="btn btn-info"
                                                   href="{{ route('bills.show' , $order->id ) }}">@lang('orders.order-details-btn')</a>
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
