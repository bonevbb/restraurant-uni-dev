@extends('layouts.login')
@section('loadCSS')
    <!-- iCheck -->
    <link href="{{ asset('plugins/iCheck/square/blue.css') }}" rel="stylesheet">
@endsection
@section('bodyStart')
    <body class="hold-transition login-page">
    @endsection

    @section('content')
        @if(count($errors) > 0)
            <section class="info-box fail">
                @foreach($errors->all() as $error)
                    {{$error}}
                @endforeach
            </section>
        @endif

        <div class="login-box">
            <div class="login-logo">
                {{--<a href="{{ url('/admin') }}"><b>Admin</b> Login</a>--}}
                <img src="{{asset('dist/img/admin/cheff.png')}}">
            </div>
            <!-- /.login-logo -->
            <div class="login-box-body">
                {{--<p class="login-box-msg">Sign in to start your session</p>--}}
                @if(Session::has('success'))
                    <div class="alert alert-success fade in alert-dismissable" style="margin-top:18px;">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
                        {{Session::get('success')}}
                    </div>
                @endif
                <form action="{{ route('admin.login') }}" method="post" role="form">
                    {{ csrf_field() }}
                    <div class="form-group has-feedback {{-- $errors->has('email') ? ' has-error' : '' --}}">
                        <input id="name" name="name" type="text" class="form-control" placeholder="Name"
                               value="{{-- old('email') --}}" required>
                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                        {{--@if ($errors->has('email'))--}}
                        {{--<span class="help-block">--}}
                        {{--<strong>{{ $errors->first('email') }}</strong>--}}
                        {{--</span>--}}
                        {{--@endif--}}
                    </div>
                    <div class="form-group has-feedback {{-- $errors->has('password') ? ' has-error' : '' --}}">
                        <input id="password" name="password" type="password" class="form-control" placeholder="Password"
                               required>
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                        {{--@if ($errors->has('password'))--}}
                        {{--<span class="help-block">--}}
                        {{--<strong>{{ $errors->first('password') }}</strong>--}}
                        {{--</span>--}}
                        {{--@endif--}}
                    </div>
                    <div class="row">
                        <div class="col-xs-8">
                            <div class="checkbox icheck">
                                <label>
                                    <input type="checkbox" name="remember" {{-- old('remember') ? 'checked' : '' --}}>
                                    Запомни ме
                                </label>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-xs-4">
                            <button type="submit" class="btn btn-primary btn-block btn-flat">Вход</button>
                        </div>
                        <!-- /.col -->
                    </div>
                    @if(Session::has('fail'))
                        {{--<section class="info-box fail">--}}
                        {{----}}
                        {{--</section>--}}
                        <div class="alert alert-danger fade in alert-dismissable" style="margin-top:18px;">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
                            <strong>{{Session::get('fail')}}</strong>
                        </div>
                    @endif
                    <input type="hidden" name="_token" value="{{Session::token()}}">
                </form>

                {{--<div class="social-auth-links text-center">--}}
                {{--<p>- OR -</p>--}}
                {{--<a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using--}}
                {{--Facebook</a>--}}
                {{--<a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using--}}
                {{--Google+</a>--}}
                {{--</div>--}}
                {{--<!-- /.social-auth-links -->--}}

                {{--<a href="{{ route('password.request') }}">I forgot my password</a><br>--}}
                {{--<a href="register.html" class="text-center">Register a new membership</a>--}}

            </div>
            <!-- /.login-box-body -->
        </div>
        <!-- /.login-box -->
    @endsection

    @section('scripts')

        <!-- iCheck -->
        <script src="{{ asset('plugins/iCheck/icheck.min.js') }}"></script>
        <script>
            $(function () {
                $('input').iCheck({
                    checkboxClass: 'icheckbox_square-blue',
                    radioClass: 'iradio_square-blue',
                    increaseArea: '20%' // optional
                });
            });
        </script>
    @endsection

    @section('bodyEnd')
    </body>
@endsection