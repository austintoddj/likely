<?php namespace App\Http\Controllers;

use App\Comments;
use App\Http\Requests\PostStatusRequest;
use Illuminate\Support\Facades\Auth;
use App\Statuses;
use App\User;

class NewsFeedController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * @return $this
     */
    public function index() {

        $data = [
            'statuses'  => User::getFeedForUser(Auth::user()),
            'followers' => User::followers(Auth::user())
        ];
        return view('pages.newsfeed')->with('data', $data);
    }

    /**
     * Post a new status
     *
     * @param \App\Http\Requests\PostStatusRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function post_status(PostStatusRequest $request) {

        Statuses::create(array(
                             'user_id' => Auth::user()->id,
                             'body'    => $request->input('status')
                         ));

        return redirect('newsfeed');
    }

}
