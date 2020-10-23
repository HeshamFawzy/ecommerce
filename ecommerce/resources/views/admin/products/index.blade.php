@extends('admin.layouts.app')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">@lang('products.title')</h1>
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
                                        <th>{{ __('products.name_en') }}</th>
                                        <th>{{ __('products.desc_en') }}</th>
                                        <th>@lang('products.cat-name')</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if ($products ?? "")
                                        @foreach ($products as $product)
                                            <tr>
                                                <td>
                                                    <div>{{ $product->name_en }}</div>
                                                </td>
                                                <td>
                                                    <div>{{ $product->description_en }}</div>
                                                </td>
                                                <td>
                                                    <div>{{ $product->categoryR->name_en }}</div>
                                                </td>
                                                <td style="width: 25%">
                                                    <div
                                                        style="display: flex; flex-direction: row; justify-content: space-around; align-items: center;">
                                                        <a class="btn btn-primary"
                                                           href="{{ route('products.show' , $product) }}"><span
                                                                class="fas fa-eye">&nbsp;</span></a>
                                                        <a class="btn btn-warning"
                                                           href="{{ route('products.edit' , $product) }}"><span
                                                                class="fas fa-pen">&nbsp;</span></a>
                                                        <form class="" method="POST"
                                                              action="{{ route('products.destroy' , $product->id) }}"
                                                              enctype="multipart/form-data>">
                                                            @method('delete')
                                                            @csrf
                                                            <button type="submit" class="btn btn-danger"><span
                                                                    class="fas fa-trash">&nbsp;</span>
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

@push('custom-foot')
    <script>
        $('#Table').DataTable({
            "language": {
                "search": "ابحث",
                "lengthMenu": "_MENU_ اظهر",
            }
        });
    </script>
@endpush
