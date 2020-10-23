@extends('admin.layouts.app')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">{{ $product->name_ar }}</h1>
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
                                <table class="table table-bordered table-responsive">
                                    <tbody>
                                    <tr>
                                        <td class="table-active">{{ __('products.name_ar') }}</td>
                                        <td>{{ $product->name_ar }}</td>
                                    </tr>
                                    <tr>
                                        <td class="table-active">{{ __('products.name_en') }}</td>
                                        <td>{{ Config::get('app.locale') == 'en' ? $product->name_ar : $product->name_en  }}</td>
                                    </tr>
                                    <tr>
                                        <td class="table-active">{{ __('products.desc_ar') }}</td>
                                        <td>{{ Config::get('app.locale') == 'en' ? $product->description_en : $product->description_ar }}</td>
                                    </tr>
                                    <tr>
                                        <td class="table-active">{{ __('products.desc_en') }}</td>
                                        <td>{{ Config::get('app.locale') == 'en' ? $product->description_ar : $product->description_en }}</td>
                                    </tr>
                                    <tr>
                                        <td class="table-active">{{ __('products.cat-name') }}</td>
                                        <td>{{ Config::get('app.locale') == 'en' ? $product->categoryR->name_en : $product->categoryR->name_ar }}</td>
                                    </tr>
                                    <tr>
                                        <td class="table-active">{{ __('products.material') }}</td>
                                        <td>{{ $product->materailR->name .' - '. $product->quantity.'m' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="table-active">{{ __('products.price') }}</td>
                                        <td>
                                            <h3>{{ $product->price}} {{Config::get('app.locale') == 'en' ? 'EGP' : 'جم' }}</h3>
                                    </tr>
                                    <tr>
                                        <td class="table-active">{{ __('products.has-discount') }}</td>
                                        @if ($product->discount == 1)
                                            <td><i class="fa fa-check-circle text-success" aria-hidden="true"></i></td>
                                            <td>{{ __('products.has-discount-amount') }}
                                                :
                                                <h3 class="label label-info">{{ $product->discountR->amount }}</h3>@if ($product->discountR->type == "amount")
                                                <td><i class="fa fa-gbp" aria-hidden="true"></i></td>
                                            @else
                                                <td><i class="fa fa-percent" aria-hidden="true"></i></td>
                                                @endif</td>
                                                <td>{{ __('products.has-discount-end-date') }}
                                                    :
                                                    <h3 class="label label-info">{{ date('Y-m-d', strtotime($product->discountR->end_date)) }}</h3>
                                                </td>
                                                @else
                                                    <td><i class="fa fa-times" aria-hidden="true"></i></td>
                                                @endif
                                    </tr>
                                    <tr>
                                        <td class="table-active">{{ __('products.available-colors') }}</td>
                                        <td>
                                            @foreach ($product->colors as $color)
                                                <h3 class="label label-info"><span
                                                        class="badge badge-info">{{ $color['name'] }}</span></h3>
                                            @endforeach
                                            <br>
                                            @foreach ($product->ImagesR as $image)
                                                <div class="row">
                                                    <div class="col-3 card card-dark">
                                                        <img style="width: 100%"
                                                             src="{{ url("products/colorImages/{$image->image_filename}") }}">
                                                    </div>
                                                    <div class="col-3 card card-dark">
                                                        <img style="width: 100%"
                                                             src="{{ url("products/colorAlterImages/{$image->alter_image_filename}") }}">
                                                    </div>
                                                </div>
                                            @endforeach
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="table-active">{{ __('products.available-sizes') }}</td>
                                        <td>
                                            @foreach ($product->sizes as $size)
                                                <h3 class="label label-info"><span
                                                        class="badge badge-info">{{ $size['name'] }}</span></h3>
                                            @endforeach
                                        </td>
                                    </tr>
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
