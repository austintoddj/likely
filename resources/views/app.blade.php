<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @yield('title')

    <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">

    <!-- Fonts -->
    <link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            @if (Auth::guest())
                <a class="navbar-brand" href="{{ url('/') }}"><span
                            style="color: rgb(58, 87, 149); font-weight: bold; font-size: 34px;">Likely</span></a>
            @else
                <a class="navbar-brand" href="{{ url('newsfeed') }}"><span
                            style="color: rgb(58, 87, 149); font-weight: bold; font-size: 34px;">Likely</span></a>
            @endif
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

            <ul class="nav navbar-nav navbar-right">
                @if (Auth::guest())
                    <li><a href="{{ url('/auth/login') }}"><span style="color: rgb(58, 87, 149);">Sign In</span></a>
                    </li>
                @else
                    <li><a style="color: rgb(58, 87, 149);" href="{{ url('newsfeed') }}"><span style="font-size: 14px;">News Feed</span></a></li>
                    <li><a style="color: rgb(58, 87, 149);" href="{{ url('users') }}"><span style="font-size: 14px;">Search</span></a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                           aria-expanded="false"><span style="color: rgb(58, 87, 149);"><img class="img-circle"
                                        src="//www.gravatar.com/avatar/{{ md5(Auth::user()->email) }}?d=retro&s=20"
                                        alt="{{ Auth::user()->username }}"
                                        style="position: relative; left: -8px; border: 1px solid rgb(204, 204, 204);"><span style="font-size: 12px;"><b>{{ Auth::user()->name }}</b></span>&nbsp;</span><span
                                    class="caret" style="color: rgb(58, 87, 149);"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="/profile"><span>My Profile</span></a></li>
                            <li class="divider"></li>
                            <li><a href="/settings">Settings</a></li>
                            <li><a href="{{ url('/auth/logout') }}">Logout</a></li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>

@yield('content')

@yield('footer')

<!-- Scripts -->
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
</body>
</html>
