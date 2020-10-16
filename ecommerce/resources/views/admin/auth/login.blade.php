@extends('admin.layouts.loginLayout')

@section('content')
    <div class="login-box animate__animated animate__bounce">
        <div class="login-logo">
            <p>Cashmere</p>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="card-body login-card-body">
                <p class="login-box-msg">@lang('auth.sign_in')</p>
                <form action="{{ route('admin.plogin') }}" method="post">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" placeholder="@lang('auth.sign_in_email')" name="email">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="@lang('auth.sign_in_password')" name="password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" id="remember" name="remember">
                                <label for="remember">
                                @lang('auth.sign_in_remember')
                                </label>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block" id="signIn">@lang('auth.sign_in_btn')</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
@endsection

@push('custom-foot')
    <script>
        $('#signIn').click(function () {
            $('.login-box').addClass('animate__zoomOutDown');
        })
    </script>
@endpush
