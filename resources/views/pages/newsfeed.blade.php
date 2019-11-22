@extends('app')

@section('title')
    <title>News Feed | Likely</title>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-circle" style="color: white;"></i>
                        <i class="fa fa-circle" style="color: white;"></i>
                        <i class="fa fa-circle" style="color: white;"></i>
                    </div>
                    <div class="panel-body">
                        <center><img src="//www.gravatar.com/avatar/{{ md5(Auth::user()->email) }}?d=retro&s=100"
                                     alt="{{ Auth::user()->username }}"
                                     style="border-radius: 150px; border: 5px solid white;"></center>
                        <center>
                            <div class="well well-sm" style="margin-top: -50px;">
                                <h3 style="margin-top: 50px;"><a href="/profile">{{ Auth::user()->name }}</a></h3>

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

                                <hr>
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
                                            </p>
                                        </center>
                                    </div>
                                </div>
                            </div>
                        </center>
                    </div>
                </div>
                <p class="text-muted"
                   style="text-align: center; margin-top: -10px; padding-bottom: 10px; color: white; font-size: 12px;">&copy;
                    2015 Likely&nbsp;&nbsp;&nbsp;&nbsp;<a style="color: white;" href="/about">About</a>&nbsp;&nbsp;&nbsp;&nbsp;<a
                            style="color: white;" href="mailto:support@imaginestudioswebdesign.com">Help</a></p>
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-8">
                <div class="panel panel-default">
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

                        <form class="form-horizontal" role="form" method="POST"
                              action="{{ action('NewsFeedController@post_status', []) }}" id="statuses">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <textarea class="form-control simplebox" name="status" value=""
                                          placeholder="What's on your mind?"
                                          style="resize: none; border: none;"></textarea>
                        </form>
                    </div>
                    <div class="panel-footer" style="overflow: hidden;">
                        <button type="submit" form="statuses" class="btn btn-primary btn-sm" style="float: right;">Post
                            a Status
                        </button>
                    </div>
                </div>

                <div class="well" style="background-color: rgb(245, 245, 245);">
                    @if(count($data['statuses']) >= 1)
                        @foreach($data['statuses'] as $status)
                            <article class="media">
                                <div class="pull-left">
                                    <a href="{{ action('UsersController@show', \App\User::findById($status->user_id)->id) }}">
                                        <img class="media-object img-circle"
                                             src="//www.gravatar.com/avatar/{{ md5(\App\User::findById($status->user_id)->email) }}?d=retro&s=50"
                                             alt="{{ \App\User::findById($status->user_id)->name }}"
                                             style="border: 1px solid rgb(204, 204, 204);">
                                    </a>
                                </div>
                                <div class="media-body">
                                    <div class="arrow_box">

                                        <a href="{{ action('UsersController@show', \App\User::findById($status->user_id)->id) }}">
                                            <h5 style="margin-left: 10px;">{{ \App\User::findById($status->user_id)->name }}
                                        </a> ·
                                        <span style="font-weight: lighter;" class="text-muted">{{ $status->created_at->diffForHumans() }}</span>
                                        </h5>

                                        <p style="margin-left: 10px; font-size: 16px;">{{ $status->body }}</p>

                                        @if(Statuses::isLikedBy(Auth::user()->id, $status->id))
                                            <form class="form-horizontal" role="form" method="POST" action="{{ action('LikesController@destroy', $status->id)}}" id="unlike">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <input type="hidden" name="statusToUnlike"
                                                       value="{{ $status->id  }}">

                                                <p style="margin-left: 10px;">
                                                    <button class="btn btn-link" style="padding: 0px; font-weight: lighter;" type="submit">Unlike</button>
                                                    &nbsp;·&nbsp;<i class="fa fa-thumbs-o-up"></i>&nbsp;{{ Statuses::numLikes($status->id) }}&nbsp;·&nbsp;<i class="fa fa-comment-o"></i>&nbsp;{{ \App\Statuses::numComments($status->id) }}
                                                </p>
                                            </form>
                                        @else
                                            <form class="form-horizontal" role="form" method="POST" action="{{ action('LikesController@store') }}" id="likes">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <input type="hidden" name="statusToLike"
                                                       value="{{ $status->id  }}">

                                                <p style="margin-left: 10px;">
                                                    <button class="btn btn-link" style="padding: 0px; font-weight: lighter;" type="submit">Like</button>
                                                    &nbsp;·&nbsp;<i class="fa fa-thumbs-o-up"></i>&nbsp;{{ Statuses::numLikes($status->id) }}&nbsp;·&nbsp;<i class="fa fa-comment-o"></i>&nbsp;{{ \App\Statuses::numComments($status->id) }}
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
                                        <hr>

                                        <form class="form-horizontal" role="form" method="POST" action="{{ action('CommentsController@store') }}" id="comments">
                                            <div class="row">
                                                <div class="col-md-9 col-sm-9 col-xs-8">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <input type="hidden" name="statusToCommentOn"
                                                           value="{{ $status->id  }}">
                                <textarea class="form-control simplebox_comments" name="comments" value=""
                                          placeholder="Write a reply..."
                                          style="resize: none; border: none;" rows="1"></textarea>
                                                </div>
                                                <div class="col-md-2 col-sm-2 col-xs-2">
                                                    <button type="submit" class="btn btn-default btn-sm" style="margin-left: 10px;">Comment</button>
                                                </div>
                                            </div>
                                        </form>
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
        </div>
    </div>
@endsection

@section('footer')
    <div class="container">
        <hr>
        <footer style="text-align: center; color: white;" class="text-muted">
            Likely is a trademark of
            <a href="http://imaginestudioswebdesign.com" target="_blank" style="font-weight: bold; color: white;">Imagine Studios</a>.Copyright &copy; 2015 Todd Austin
            <br>
            <br>
            Design by Todd Austin | English (US)
        </footer>
    </div>
@endsection