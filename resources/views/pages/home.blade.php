@extends('app')

@section('title')
    <title>Welcome to Likely - Log In or Sign Up</title>
@endsection

@section('content')
    <div class="container">
        <div class="col-md-1"></div>
        <div class="col-md-10">
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-circle" style="color: white;"></i>
                <i class="fa fa-circle" style="color: white;"></i>
                <i class="fa fa-circle" style="color: white;"></i>
            </div>
            <div class="panel-body">

                <h1 style="font-weight: lighter; font-size: 52px; color: rgb(58, 87, 149);">Hello.</h1>

                <p class="lead" style="color: rgb(58, 87, 149);">This is Likely. The social
                    network for making new friends. Connect
                    with the people that mean the most to you, and share the news that's most relevant to you. It's free
                    and anyone can join. <a style="color: rgb(58, 87, 149);" href="/about">Click to learn more!</a></p>

                <p style="text-align: center;">
                    <a href="{{ url('/auth/register') }}" class="btn btn-md btn-success"
                       style="box-shadow:  0px 0px 200px #FFF;">Click Here To Sign Up</a>
                </p>

                <hr style="width: 50%;">
                <center><span style="color: rgb(58, 87, 149);">Already on Likely? <a href="{{ url('/auth/login') }}"
                                                                                     style="color: rgb(58, 87, 149);"><b>Sign
                                In</b></a></span></center>

            </div>
        </div>
        </div>
        <div class="col-md-1"></div>
        <br>

        <div class="row">
            <center>
                <div class="col-md-4 col-sm-4 col-xs-4">
                    <i class="fa fa-newspaper-o fa-5x" style="color: white;"></i>
                    <br>
                    <br>

                    <p style="font-size: 18px; color: white;">
                        <b>See the latest updates</b> from friends in your own News Feed.
                    </p>
                </div>
            </center>
            <center>
                <div class="col-md-4 col-sm-4 col-xs-4">
                    <i class="fa fa-users fa-5x" style="color: white;"></i>
                    <br>
                    <br>

                    <p style="font-size: 18px; color: white;">
                        <b>Connect with friends</b>, past or present as you grow your social network.
                    </p>
                </div>
            </center>
            <center>
                <div class="col-md-4 col-sm-4 col-xs-4">
                    <i class="fa fa-mobile fa-5x" style="color:white;"></i>
                    <br>
                    <br>

                    <p style="font-size: 18px; color: white;">
                        <b>Browse anywhere</b>, with any device, wherever you go.
                    </p>
                </div>
            </center>
        </div>

    </div>
@stop

@section('footer')
    <div class="container">
        <hr>
        <footer style="text-align: center; color: white;" class="text-muted">
            Likely is a trademark of <a href="http://imaginestudioswebdesign.com" target="_blank"
                                        style="font-weight: bold; color: white;">Imagine Studios</a>.
            Copyright &copy; 2015 Todd Austin
            <br>
            <br>
            Design by Todd Austin | English (US)
        </footer>
    </div>
@endsection