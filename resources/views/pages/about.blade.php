@extends('app')

@section('title')
    <title>About | Likely</title>
@endsection

@section('content')
    <div class="container">
        <div class="col-md-1"></div>
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-circle" style="color: white;"></i>
                    <i class="fa fa-circle" style="color: white;"></i>
                    <i class="fa fa-circle" style="color: white;"></i>
                </div>
                <div class="panel-body">
                    <div class="jumbotron"
                         style="background: url(http://443.nmdprojects.net/blog/wp-content/uploads/2014/01/People-walking-blur-low-res.jpg) no-repeat fixed center center">
                        <div class="container">
                            <center>
                                <h1 style="color: white; font-size: 52px; text-shadow: 2px 2px 2px black;">About Likely</h1>

                                <p class="lead" style="color: white; font-size: 26px; text-shadow: 2px 2px 2px black;">Likely helps you create and share
                                    ideas and information instantly, without barriers.</p>
                            </center>
                        </div>
                        <hr>
                        <div class="row">
                            <center>
                                <div class="col-md-4 col-sm-4 col-xs-4">
                                    <i class="fa fa-newspaper-o fa-5x" style="color: white; text-shadow: 2px 2px 2px black;"></i>
                                    <br>
                                    <br>

                                    <p style="font-size: 18px; color: white; text-shadow: 2px 2px 2px black;">
                                        <b>See the latest updates</b> from friends in your own News Feed.
                                    </p>
                                </div>
                            </center>
                            <center>
                                <div class="col-md-4 col-sm-4 col-xs-4">
                                    <i class="fa fa-users fa-5x" style="color: white; text-shadow: 2px 2px 2px black;"></i>
                                    <br>
                                    <br>

                                    <p style="font-size: 18px; color: white; text-shadow: 2px 2px 2px black;">
                                        <b>Connect with friends</b>, past or present as you grow your social network.
                                    </p>
                                </div>
                            </center>
                            <center>
                                <div class="col-md-4 col-sm-4 col-xs-4">
                                    <i class="fa fa-mobile fa-5x" style="color: white; text-shadow: 2px 2px 2px black;"></i>
                                    <br>
                                    <br>

                                    <p style="font-size: 18px; color: white; text-shadow: 2px 2px 2px black;">
                                        <b>Browse anywhere</b>, with any device, wherever you go.
                                    </p>
                                </div>
                            </center>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

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
