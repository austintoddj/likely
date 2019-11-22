<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Likes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;

class LikesController extends Controller {

    /**
     * Like a status.
     *
     * @return Response
     */
    public function store() {
        $id = Input::get('statusToLike');

        Likes::create(array(
                          'liker_id'   => Auth::id(),
                          'status_id' => $id
                      ));

        return Redirect::back();
    }

    /**
     * Unlike a status.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id) {
        DB::table('likes')->where('liker_id', '=', Auth::user()->id)->where('status_id', '=', $id)->delete();
        return Redirect::back();
    }

}
