@extends('app')

@section('title')
    <title>{{ $data['user_id']->name }} | Likely</title>
@endsection
{{--{{ dd($data) }}--}}
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
                                     src="//www.gravatar.com/avatar/{{ md5($data['user_id']->email) }}?d=retro&s=225"
                                     alt="{{ $data['user_id']->name }}"
                                     style="border: 1px solid rgb(204, 204, 204);">
                            </center>
                        </div>
                        <div class="col-md-6">
                            <center>
                                @if($data['user_id']->isFollowedBy(Auth::user()))
                                    <form class="form-inline"
                                          action="{{ action('FollowersController@destroy', $data['user_id']->id) }}"
                                          method="POST">
                                        <input type="hidden" name="userIdToUnfollow"
                                               value="{{ $data['user_id']->id  }}">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                        <h2>
                                            <a href="{{ action('UsersController@show', $data['user_id']->id) }}">{{ $data['user_id']->name }}</a>
                                            <span style="font-weight: 100;">|</span>
                                            <button class="btn btn-sm btn-danger" type="submit">Unfollow</button>
                                        </h2>
                                    </form>
                                @else
                                    <form class="form-inline" action="{{ action('FollowersController@store') }}"
                                          method="POST">
                                        <input type="hidden" name="userIdToFollow" value="{{ $data['user_id']->id  }}">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                        <h2>
                                            <a href="{{ action('UsersController@show', $data['user_id']->id) }}">{{ $data['user_id']->name }}</a>
                                            <span style="font-weight: 100;">|</span>
                                            <button class="btn btn-sm btn-primary" type="submit">Follow</button>
                                        </h2>
                                    </form>
                                @endif

                                <p class="text-muted"><i class="fa fa-clock-o"></i>&nbsp;Joined
                                    {{ date("F d, Y", strtotime($data['user_id']->created_at)) }}</p>

                                @if(!empty($data['user_id']->website) && $data['user_id']->website != " ")
                                    <p class="text-muted"><i class="fa fa-link"></i>&nbsp;<a target="_blank"
                                                                                             href="http://www.{{ $data['user_id']->website }}">{{ $data['user_id']->website }}</a>
                                    </p>
                                @endif

                                @if(!empty($data['user_id']->location) && $data['user_id']->location != " ")
                                    <p class="text-muted"><i
                                                class="fa fa-map-marker"></i>&nbsp;{{ $data['user_id']->location }}
                                    </p>
                                @endif
                            </center>
                            <hr>
                            <center>
                                <div class="row">
                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <center>
                                            <p class="text-muted" style="font-size: 14px;">POSTS<br/>
                                                @if(count($data['statuses']) >= 1)
                                                    <span style="color: rgb(58, 87, 149); font-weight: bold; font-size: 16px;">{{ count($data['statuses']) }}</span>
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
                                <a href="/&commat;{{ $data['user_id']->id }}">
                                    <img class="media-object img-circle"
                                         src="//www.gravatar.com/avatar/{{ md5($data['user_id']->email) }}?d=retro&s=50"
                                         alt="{{ Auth::user()->username }}"
                                         style="border: 1px solid rgb(204, 204, 204);">
                                </a>
                            </div>
                            <div class="media-body">
                                <div class="arrow_box">
                                    <a href="/&commat;{{ $data['user_id']->id }}">
                                        <h5 style="margin-left: 10px;">{{ $data['user_id']->name }}</a> · <span
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