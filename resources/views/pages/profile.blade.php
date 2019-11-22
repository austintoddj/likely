@extends('app')

@section('title')
    <title>My Profile | Likely</title>
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
                    <div class="row">
                        <div class="col-md-5">
                            <center>
                                <img class="img-circle"
                                     src="//www.gravatar.com/avatar/{{ md5(Auth::user()->email) }}?d=retro&s=225"
                                     alt="{{ Auth::user()->username }}"
                                     style="border: 1px solid rgb(204, 204, 204);">
                            </center>
                        </div>
                        <div class="col-md-6">
                            <center>
                                <h2><a href="/profile">{{ Auth::user()->name }}</a> <span
                                            style="font-weight: 100;">|</span> <a href="/settings">
                                        <btn class="btn btn-sm btn-default">Edit Profile</btn>
                                    </a></h2>

                                <p class="text-muted"><i class="fa fa-clock-o"></i>&nbsp;Joined
                                    {{ date("F d, Y", strtotime(Auth::user()->created_at)) }}</p>

                                @if(!empty(Auth::user()->website) && Auth::user()->website != " ")
                                    <p class="text-muted"><i class="fa fa-link"></i>&nbsp;<a target="_blank"
                                                                                             href="http://www.{{ Auth::user()->website }}">{{ Auth::user()->website }}</a>
                                    </p>
                                @endif

                                @if(!empty(Auth::user()->location) && Auth::user()->location != " ")
                                    <p class="text-muted"><i
                                                class="fa fa-map-marker"></i>&nbsp;{{ Auth::user()->location }}
                                    </p>
                                @endif
                            </center>
                            <hr>
                            <center>
                                <div class="row">
                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <center>
                                            <p class="text-muted" style="font-size: 14px;">POSTS<br/>
                                                @if(Auth::user()->authUserStatus() >= 1)
                                                    <span style="color: rgb(58, 87, 149); font-weight: bold; font-size: 16px;">{{ Auth::user()->authUserStatus() }}</span>
                                                @else
                                                    <span style="color: rgb(58, 87, 149); font-weight: bold; font-size: 16px;">
                                                    0
                                                </span>
                                                @endif
                                            </p>
                                        </center>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <center><p class="text-muted" style="font-size: 14px;">FRIENDS<br/>
                                                @if(count($data['followers']) >= 1)
                                                    <span style="color: rgb(58, 87, 149); font-weight: bold; font-size: 14px;">{{ count($data['followers']) }}</span>
                                                @else
                                                    <span style="color: rgb(58, 87, 149); font-weight: bold; font-size: 16px;">
                                                    0
                                                </span>
                                                @endif
                                            </p></center>
                                    </div>
                                </div>
                            </center>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-1"></div>
    </div>

    <div class="container">
        <div class="col-md-1"></div>
        <div class="col-md-10">
            <div class="well" style="background-color: rgb(245, 245, 245);">
                @if(count($data['statuses']) >= 1)
                    @foreach($data['statuses'] as $status)
                        <article class="media">
                            <div class="pull-left">
                                <a href="/profile">
                                    <img class="media-object img-circle"
                                         src="//www.gravatar.com/avatar/{{ md5(Auth::user()->email) }}?d=retro&s=50"
                                         alt="{{ Auth::user()->username }}"
                                         style="border: 1px solid rgb(204, 204, 204);">
                                </a>
                            </div>
                            <div class="media-body">
                                <div class="arrow_box">
                                    <a href="/profile">
                                        <h5 style="margin-left: 10px;">{{ Auth::user()->name }}</a> · <span
                                            style="font-weight: lighter;"
                                            class="text-muted">{{ $status->created_at->diffForHumans() }}</span>
                                    </h5>

                                    <p style="margin-left: 10px; font-size: 16px;">{{ $status->body }}</p>

                                    @if(Statuses::isLikedBy(Auth::user()->id, $status->id))
                                        <form class="form-horizontal" role="form" method="POST" action="{{ action('LikesController@destroy', $status->id)}}" id="unlike">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="hidden" name="statusToUnlike"
                                                   value="{{ $status->id  }}">

                                            <p style="margin-left: 10px;">
                                                <button class="btn btn-link" style="padding: 0px; font-weight: lighter;" type="submit">Unlike</button>&nbsp;·&nbsp;<i class="fa fa-thumbs-o-up"></i>&nbsp;{{ Statuses::numLikes($status->id) }}&nbsp;·&nbsp;<i class="fa fa-comment-o"></i>&nbsp;{{ \App\Statuses::numComments($status->id) }}
                                            </p>
                                        </form>
                                    @else
                                        <form class="form-horizontal" role="form" method="POST" action="{{ action('LikesController@store') }}" id="likes">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="hidden" name="statusToLike"
                                                   value="{{ $status->id  }}">

                                            <p style="margin-left: 10px;">
                                                <button class="btn btn-link" style="padding: 0px; font-weight: lighter;" type="submit">Like</button>&nbsp;·&nbsp;<i class="fa fa-thumbs-o-up"></i>&nbsp;{{ Statuses::numLikes($status->id) }}&nbsp;·&nbsp;<i class="fa fa-comment-o"></i>&nbsp;{{ \App\Statuses::numComments($status->id) }}
                                            </p>
                                        </form>
                                    @endif

                                    @if(\App\Statuses::isCommentedOn($status->id))
                                        <hr>
                                        @foreach(Statuses::commentedOn($status->id) as $comment)
                                            <div class="pull-left">
                                                <a href="{{ action('UsersController@show', \App\User::findById($comment->user_id)->id) }}">
                                                    <img class="media-object img-circle"
                                                         src="//www.gravatar.com/avatar/{{ md5(\App\User::findById($comment->user_id)->email) }}?d=retro&s=30"
                                                         alt="{{ \App\User::findById($comment->user_id)->name }}"
                                                         style="border: 1px solid rgb(204, 204, 204);">
                                                </a>
                                            </div>
                                            <div class="media-body">

                                                <a href="{{ action('UsersController@show', \App\User::findById($comment->user_id)->id) }}">
                                                    <h5 style="margin-left: 10px;">{{ \App\User::findById($comment->user_id)->name }}
                                                </a> ·
                                                <span style="font-weight: lighter;" class="text-muted">{{ $comment->created_at->diffForHumans() }}</span>
                                                </h5>

                                                <p style="margin-left: 10px; font-size: 14px;">{{ $comment->body }}</p>
                                            </div>
                                        @endforeach
                                    @endif

                                </div>
                            </div>
                        </article>
                    @endforeach
                @else
                    <center>
                        <i class="fa fa-newspaper-o fa-5x" style="color: #ccc;"></i>

                        <h2 style="color: #ccc;">No posts to show</h2>
                    </center>
                @endif
            </div>
        </div>
        <div class="col-md-1"></div>
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