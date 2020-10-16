<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Cashmere</title>
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('assets/admin/dist/css/adminlte.min.css') }}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
          integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
    @toastr_css
    @stack('custom-head')
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
    <!-- Navbar -->
@include('admin.layouts.includes.nav')
<!-- /.navbar -->
    <!-- Main Sidebar Container -->
@include('admin.layouts.includes.mainSidebar')
<!-- Content Wrapper. Contains page content -->
    <div class="animate__animated animate__bounceInUp">
        @yield('content')
    </div>
    <!-- /.content-wrapper -->
    <!-- Main Footer -->
    @include('admin.layouts.includes.footer')
</div>
<!-- ./wrapper -->
<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="{{ asset('assets/admin/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('assets/admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('assets/admin/dist/js/adminlte.min.js') }}"></script>
<script src="https://js.pusher.com/7.0/pusher.min.js"></script>
<script>

    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var pusher = new Pusher('78fc63d6195d47513ffa', {
        cluster: 'mt1'
    });

    var role = "{{ \Illuminate\Support\Facades\Auth::guard('admin')->user()->roles->pluck('name')->first() }}";

    if (role == "Ordered") {
        var channel = pusher.subscribe('Ordered');
    } else if (role == "Chopping") {
        var channel = pusher.subscribe('Chopping');
    } else if (role == "Finishing") {
        var channel = pusher.subscribe('Finishing');
    } else if (role == "Delivered") {
        var channel = pusher.subscribe('Delivered');
    } else if (role == "Done") {
        var channel = pusher.subscribe('Done');
    } else {
        var channel = pusher.subscribe('Ordered');
    }
    var orders = document.getElementById('orders').innerText;
    channel.bind('order', function (data) {
        orders = parseInt(orders) + 1;
        document.getElementById('orders').innerText = orders;
        alert(JSON.stringify(data));
    });

</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/jquery.dataTables.min.js"
        integrity="sha512-BkpSL20WETFylMrcirBahHfSnY++H2O1W+UnEEO4yNIl+jI2+zowyoGJpbtk6bx97fBXf++WJHSSK2MV4ghPcg=="
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"
        integrity="sha512-s+xg36jbIujB2S2VKfpGmlC3T5V2TF3lY48DX7u2r9XzGzgPsa6wTpOQA7J9iffvdeBN0q9tKzRxVxw1JviZPg=="
        crossorigin="anonymous"></script>
@stack('custom-foot')
</body>
@toastr_js
@toastr_render
</html>
