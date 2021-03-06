@extends('admin.layouts.app')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">{{ __('admins.create') }}</h1>
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
                                    <div class="container">
                                        <form action="{{ route('systemUsers.store') }}" method="POST"
                                              enctype="multipart/form-data">
                                            @csrf
                                            <div class="row">
                                                <h6>{{ __('admins.name') }}</h6>
                                                <input type="text" class="form-control"
                                                       placeholder="Please Enter a User Name" name="userName" required>
                                            </div>
                                            <div class="row">
                                                <h6>{{ __('admins.email') }}</h6>
                                                <input type="email" class="form-control"
                                                       placeholder="Please Enter a User Email" name="userEmail"
                                                       required>
                                            </div>
                                            <div class="row">
                                                <h6>{{ __('admins.password') }}</h6>
                                                <input type="password" class="form-control"
                                                       placeholder="Please Enter a User Password" name="userPassword"
                                                       required>
                                            </div>
                                            <div class="row">
                                                <h6>{{ __('admins.roles') }}</h6>
                                            </div>
                                            <div class="row">
                                                @foreach ($roles as $role)
                                                    @if($role->name == 'superAdmin')
                                                        <div class="form-check p-3 badge badge-warning col-12">
                                                            <input class="form-check-input" type="checkbox"
                                                                   id="superRole"
                                                                   value="{{ $role->name }}" name="userRoles[]">
                                                            <label class="form-check-label"
                                                                   for="formInput111">{{ __('admins.order-status-' . $role->name) }}</label>
                                                        </div>
                                                    @else
                                                        <div class="form-check p-3 col-12 otherRoles">
                                                            <input class="form-check-input otherRoles" type="checkbox"
                                                                   value="{{ $role->name }}" name="userRoles[]">
                                                            <label class="form-check-label"
                                                                   for="formInput111">{{ __('admins.order-status-' . $role->name) }}</label>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                            <button class="btn btn-success float-right mt-3" type="submit"><span
                                                    class="fas fa-user-plus"></span>
                                            </button>
                                        </form>
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
        $(function () {
            $("#superRole").click(function () {
                if ($(this).is(":checked")) {
                    $(".otherRoles").hide();
                } else {
                    $(".otherRoles").show();
                }
            });
        })
    </script>
@endpush
