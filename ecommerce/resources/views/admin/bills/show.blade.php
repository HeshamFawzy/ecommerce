@extends('admin.layouts.app')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">@lang('orders.details')</h1>
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
                                        <th scope="col">@lang('orders.details-name')</th>
                                        <th scope="col">@lang('orders.details-qty')</th>
                                        <th scope="col">@lang('orders.details-color')</th>
                                        <th scope="col">@lang('orders.details-size')</th>
                                        <th scope="col">@lang('orders.details-bill')</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($orderProducts as $orderProduct)
                                        <tr>
                                            <td>{{ Config::get('app.locale') == 'en' ? $orderProduct->productR->name_en : $orderProduct->productR->name_ar }}</td>
                                            <td>{{ $orderProduct->quantity }}</td>
                                            <td>{{ $orderProduct->colorR->name_ar }}</td>
                                            <td>{{ $orderProduct->sizeR->name }}</td>
                                            <td class="text text-warning">{{ $orderProduct->productR->price * $orderProduct->quantity}}</td>
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

