<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Comments;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\CommentsRequest;

class CommentsController extends Controller {

    /**
     * Comment on a status.
     *
     * @param \App\Http\Requests\CommentsRequest $request
     *
     * @return \App\Http\Controllers\Response
     */
    public function store() {
        $id    = Input::get('statusToCommentOn');
        $input = Input::get('comments');

        if(!empty($input)) {
            Comments::create(array(
                                 'user_id'   => Auth::id(),
                                 'status_id' => $id,
                                 'body'      => $input
                             ));

            return Redirect::back();
        } else {
            return Redirect::back();
        }
    }

}
