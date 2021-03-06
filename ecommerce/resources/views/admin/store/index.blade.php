@extends('admin.layouts.app')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Store</h1>
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
                                    <div>
                                        <form action="" method="POST"
                                              enctype="multipart/form-data">
                                            @csrf
                                            <h6>{{ __('materials.name') }}</h6>
                                            <input type="text" class="form-control"
                                                   placeholder="Please Enter a Material Name"
                                                   name="materialName" required>
                                            <h6>{{ __('materials.quantity') }}</h6>
                                            <input type="number" class="form-control"
                                                   placeholder="Please Enter a Material Quantity"
                                                   name="quantity" required>
                                            <button type="submit" class="btn btn-success float-right mt-3"><span
                                                    class="fas fa-plus"></span>
                                            </button>
                                        </form>
                                    </div>
                                    <div style="clear: both"></div>
                                    <div class="pt-5">
                                        <table class="table table-striped" id="Table">
                                            <thead>
                                            <tr>
                                                <th scope="col">{{ __('materials.name') }}</th>
                                                <th scope="col">{{ __('materials.quantity') }}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach ($materails as $materail)
                                                <tr>
                                                    <td>{{ $materail->name }}</td>
                                                    <td>{{ $materail->quantity }}</td>
                                                    <td>
                                                        <form class="" method="POST"
                                                              action="{{ route('store.destroy' , $materail->id) }}"
                                                              enctype="multipart/form-data>">
                                                            @method('delete')
                                                            @csrf
                                                            <button type="submit" class="btn btn-danger mt-2"><span
                                                                    class="fas fa-trash"></span>
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
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
