@extends('app')

@section('title')
    <title>Account Settings | Likely</title>
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
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> There were some problems with your input.<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if(Session::has('message'))
                        <div class="alert alert-success">
                            <p>{{ Session::get('message') }}</p>
                        </div>
                    @endif
                    <form class="form-horizontal" role="form" method="POST"
                          action="{{ action('PagesController@update_settings', []) }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <div class="form-group">
                            <div class="col-md-2"></div>
                            <div class="col-md-6">
                                <h1 style="color: rgb(58, 87, 149);">Account</h1>

                                <p class="lead" style="color: rgb(58, 87, 149);">Change your basic account settings.</p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label">Name</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="name" value="{{ Auth::user()->name }}"
                                       placeholder="Name">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label">Email</label>

                            <div class="col-md-6">
                                <input type="email" class="form-control" name="email" value="{{ Auth::user()->email }}"
                                       placeholder="Email">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label">Website</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="website"
                                       placeholder="Got a website?" value="{{ Auth::user()->website }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label">Location</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="location"
                                       placeholder="Where are you?" value="{{ Auth::user()->location }}">
                            </div>
                        </div>

                        <hr>

                        <div class="form-group">

                            <div class="col-md-2"></div>
                            <div class="col-md-6">
                                <div class="well well-sm">
                                    <div class="row">
                                        <div class="col-md-4 col-sm-4 col-xs-4">
                                            <img src="//www.gravatar.com/avatar/{{ md5(Auth::user()->email) }}?d=retro&s=100"
                                                 style="border-radius: 150px; border: 5px solid white;"
                                                 alt="{{ Auth::user()->name }}">
                                        </div>
                                        <div class="col-md-8 col-sm-8 col-xs-8">
                                            <span class="help-block">To change your picture, please visit <a
                                                        href="http://www.gravatar.com">Gravatar.com</a> to upload a new one.</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-2">
                                <button type="submit" class="btn btn-success btn-block">
                                    Save Changes
                                </button>
                            </div>
                        </div>
                    </form>
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
