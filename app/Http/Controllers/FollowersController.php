<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Follows;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class FollowersController extends Controller {

    /**
     * Follow a user.
     *
     * @param $id
     *
     * @return \App\Http\Controllers\Response
     */
    public function store() {
        $id = Input::get('userIdToFollow');

        Follows::create(array(
                            'follower_id' => Auth::id(),
                            'followed_id' => $id
                        ));

        return Redirect::back();
    }

    /**
     * Unfollow a user.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id) {
        DB::table('follows')->where('follower_id', '=', Auth::user()->id)->where('followed_id', '=', $id)->delete();
        return Redirect::back();
    }

}
