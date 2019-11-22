@extends('app')

@section('title')
    <title>Sign into Likely | Likely</title>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
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

                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/auth/login') }}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            <div class="form-group">
                                <div class="col-md-2"></div>
                                <div class="col-md-6">
                                    <h1 style="color: rgb(58, 87, 149);">Sign In</h1>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label"></label>

                                <div class="col-md-6">
                                    <input type="email" class="form-control" name="email" value="{{ old('email') }}"
                                           placeholder="Email" autofocus>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label"></label>

                                <div class="col-md-6">
                                    <input type="password" class="form-control" name="password" placeholder="Password">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-2">
                                    <div class="checkbox">
                                        <label style="color: rgb(58, 87, 149);">
                                            <input type="checkbox" name="remember"> Remember Me
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-2">
                                    <button type="submit" class="btn btn-primary">Login</button>

                                    <a class="btn btn-link" href="{{ url('/password/email') }}" style="color: rgb(58, 87, 149);">Forgot
                                        Your Password?</a>
                                </div>
                            </div>
                        </form>
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
            Likely is a trademark of <a href="http://imaginestudioswebdesign.com" target="_blank" style="font-weight: bold; color: white;">Imagine Studios</a>.
            Copyright &copy; 2015 Todd Austin
            <br>
            <br>
            Design by Todd Austin | English (US)
        </footer>
    </div>
@endsection
