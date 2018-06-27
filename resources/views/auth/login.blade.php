<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>INSPINIA | Login</title>

    <link href="{{url('admin/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{url('admin/font-awesome/css/font-awesome.css')}}" rel="stylesheet">

    <link href="{{url('admin/css/animate.css')}}" rel="stylesheet">
    <link href="{{url('admin/css/style.css')}}" rel="stylesheet">

</head>

<body class="gray-bg">

<div class="middle-box text-center loginscreen animated fadeInDown">
    <div>
        <div>

            <h1 class="logo-name">IN+</h1>

        </div>
        <form class="form-horizontal m-t" role="form" method="POST" action="{{ route('login') }}">

            {{ csrf_field() }}

            <div class="form-group">
                <input type="email" class="form-control" name="email" required autofocus>
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary block full-width m-b">登录</button>

            <a href="{{ route('password.request') }}"><small>Forgot password?</small></a>
            <a class="btn btn-sm btn-white btn-block" href="{{ route('register') }}">注册一个新用户</a>

        </form>
        <p class="m-t"> <small>Inspinia we app framework base on Bootstrap 3 &copy; 2014</small> </p>
    </div>
</div>

<!-- Mainly scripts -->
<script src="{{url('admin/js/jquery-3.1.1.min.js')}}"></script>
<script src="{{url('admin/js/bootstrap.min.js')}}"></script>

</body>

</html>