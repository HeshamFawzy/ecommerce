@extends('admin.layouts.app')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">{{ __('admins.title') }}</h1>
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
                                        <th scope="col">{{ __('admins.name') }}</th>
                                        <th scope="col">{{ __('admins.email') }}</th>
                                        <th scope="col">{{ __('admins.roles') }}</th>
                                        <th scope="col">{{ __('admins.actions') }}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($systemUsers as $key => $systemUser)
                                        <tr>
                                            <td>{{ $systemUser->name }}</td>
                                            <td>{{ $systemUser->email }}</td>
                                            <td>@foreach ($systemUser->roles->pluck('name') as $role)
                                                    {{ __('admins.order-status-'.$role) }}
                                                @endforeach</td>
                                            <td>
                                                <a class="btn btn-warning"
                                                   href="{{ route('systemUsers.edit' , $systemUser) }}"><span
                                                        class="fas fa-pen"></span> </a>
                                                <form class="" method="POST"
                                                      action="{{ route('systemUsers.destroy' , $systemUser->id) }}"
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
                        {!! $systemUsers->render() !!}
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
        $(document).ready(function () {
            $('#Table').DataTable({
                "language": {
                    "search": "ابحث",
                    "lengthMenu": "_MENU_ اظهر",
                }
            });
        });
    </script>
@endpush
