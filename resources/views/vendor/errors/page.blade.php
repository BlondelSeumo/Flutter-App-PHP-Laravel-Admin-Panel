
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{setting('app_name','Adminy')}} | {{trans('auth.login')}}</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('plugins/font-awesome/css/font-awesome.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('dist/css/adminlte.css')}}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{asset('plugins/iCheck/flat/blue.css')}}">
<!-- Google Font: Poppins -->
    <<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,400i,700" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/custom.css')}}">
</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="card">
        <div class="card-body login-card-body text-center">
            <h1 class="error-code"><i class="fa fa-warning m-2 text-warning"></i>{{$code}}</h1>
            <p class="my-3">{!! $message !!}</p>
        </div>
        <div class="btn-group w-100">
        <a class="btn btn-warning btn-sm w-50" href="{{url()->previous()}}">
            <i class="fa fa-arrow-circle-left m-1"></i>{{trans('error.back')}}</a>
        <a class="btn btn-warning btn-sm w-50" href="{{route('users.profile')}}">
            <i class="fa fa-user-circle m-1"></i>{{trans('error.back_to_home')}}</a>
        </div>
        <!-- /.login-card-body -->
    </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
</body>
</html>

