@extends('admin.layouts.app')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">{{ __('sizes.title') }}</h1>
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
                                        <th scope="col">{{ __('sizes.name') }}</th>
                                        <th scope="col">{{ __('sizes.delete') }}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($sizes as $size)
                                        <tr>
                                            <td>{{ $size->name }}</td>
                                            <td>
                                                <form class="" method="POST"
                                                      action="{{ route('sizes.destroy' , $size->id) }}"
                                                      enctype="multipart/form-data>">
                                                    @method('delete')
                                                    @csrf
                                                    <button type="submit"
                                                            class="btn btn-danger mt-2"><span
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
