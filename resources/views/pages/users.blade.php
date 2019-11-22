@extends('app')

@section('title')
    <title>Friend Finder | Likely</title>
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
                    <h1 style="color: rgb(58, 87, 149);">Friend Finder</h1>

                    <p class="lead" style="color: rgb(58, 87, 149);">Reconnect with a friend, or meet someone new!</p>
                    @foreach($users->chunk(4) as $userSet)
                        <div class="row" style="margin-bottom: 15px;">
                            @foreach($userSet as $user)
                                <center>
                                <div class="col-md-3 col-sm-3 col-xs-3">
                                    <a href="{{ action('UsersController@show', $user->id) }}">
                                        <img class="img-circle" src="//www.gravatar.com/avatar/{{ md5($user->email) }}?d=retro&s=70"
                                         alt="{{ $user->name }}">
                                        <p style="font-size: 16px;" class="lead">{{ $user->name }}</p>
                                    </a>
                                </div>
                                </center>
                            @endforeach
                        </div>
                    @endforeach
                    <hr>
                    <center>
                        {!! $users->render() !!}
                    </center>
                </div>
            </div>
        </div>
        <div class="col-md-1"></div>
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