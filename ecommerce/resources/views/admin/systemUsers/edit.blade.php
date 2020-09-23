@extends('admin.layouts.app')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Edit System User</h1>
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
                                        <form action="{{ route('systemUsers.update' , $user) }}" method="POST"
                                              enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="row">
                                                <h6>User Name :</h6>
                                                <input type="text" class="form-control"
                                                       placeholder="Please Enter a User Name" name="userName"
                                                       value="{{ $user->name }}" required>
                                            </div>
                                            <div class="row">
                                                <h6>User Email:</h6>
                                                <input type="email" class="form-control"
                                                       placeholder="Please Enter a User Email"
                                                       value="{{ $user->email }}" name="userEmail"
                                                       required>
                                            </div>
                                            <div class="row">
                                                <h6>User Password:</h6>
                                                <input type="password" class="form-control"
                                                       placeholder="Please Enter a User Password"
                                                       name="userPassword"
                                                >
                                            </div>
                                            <div class="row">
                                                <h6>User Roles:</h6>
                                            </div>
                                            <div class="row">
                                                @foreach ($roles as $role)
                                                    <div class="form-check p-3">
                                                        <input class="form-check-input" type="checkbox"
                                                               id="formInput111"
                                                               value="{{ $role->name }}" name="userRoles[]"
                                                               @foreach ($user->roles->pluck('name') as $uRoles) @if ($uRoles == $role->name) checked @endif @endforeach>
                                                        <label class="form-check-label"
                                                               for="formInput111">{{ $role->name }}</label>
                                                    </div>
                                                @endforeach
                                            </div>
                                            <button class="btn btn-success float-right mt-3" type="submit">Edit User
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
