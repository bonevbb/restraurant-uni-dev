<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel Tutorials</title>
    <!-- Styles -->
    <link href="{{ asset('bootstrap/css/bootstrap.css') }}" rel="stylesheet">
</head>
<body>
<style>
    .loading {
        background: url('{{asset('img/processing.gif')}}') no-repeat center 65%;
        height: 200px;
        /*width: 100px;*/
        /*position: fixed;*/
        /*border-radius: 4px;*/
        /*z-index: 2000;*/
        display: none;
    }
</style>
<div class="container-fluid">
    <div class="row"></div>
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <nav class="navbar navbar-default">
                <div class="container-fluid">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                                data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="#">Header</a>
                    </div>
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav navbar-right">
                            <li class="nav_home active">
                                <a href="tutorial\#home1">
                                    <i class="glyphicon glyphicon-home"></i>
                                    Home
                                </a>
                            </li>
                            <li class="nav_about-us active">
                                <a href="tutorial\#about-us">
                                    <i class="glyphicon glyphicon-user"></i>
                                    About Us
                                </a>
                            </li>

                        </ul>
                    </div>
                    <!-- /.navbar-collapse -->
                </div>
                <!-- /.container-fluid -->
            </nav>
            <div id="content">click any menu above to change content here</div>
            <div class="loading"></div>
        </div>
        <div class="col-md-3"></div>
    </div>
</div>
<!-- JavaScripts -->
<script src="{{ asset('js/jquery-1.12.4.js') }}"></script>
<script src="{{ asset('bootstrap/js/bootstrap.js') }}"></script>
<script src="{{ asset('js/routie.js') }}"></script>
<script>
    $(document).ready(function () {
        routie('*', function () {
            var url = window.location.href;
            var p = url.indexOf('#');
            if (p > -1) {
                var controllerAction = url.substr(url.indexOf('#') + 1);
                var pos = controllerAction.indexOf('*');
                var menu = controllerAction;
                if (pos > -1)
                    menu = controllerAction.substr(0, pos);
                activeMenu("nav_" + menu.replace('/', '_'));
                ajaxLoad(controllerAction.replace('*', '/'));
            } else {
                activeMenu("nav_home");
                ajaxLoad('home1');
            }
        });
        function activeMenu(nav) {
            $('.nav li.active').removeClass('active');
            $(".nav ." + nav).addClass('active');
        }
    });
    function ajaxLoad(filename, content) {
        content = typeof content !== 'undefined' ? content : 'content';
        $('#content').hide();
        $('.loading').show();

        $.ajax({
            type: "GET",
            url: filename,
            contentType: false,
            success: function (data) {
                $("#" + content).html(data);
                $('.loading').hide();
                $('#content').show();
            },
            error: function (xhr, status, error) {
                alert(xhr.responseText);
            }
        });
    }
</script>
</body>
</html>