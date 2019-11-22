<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller {

    /**
     * Display a list of all users.
     *
     * @return Response
     */
    public function index() {
        return view('pages.users')->with('users', DB::table('users')->where('id', '!=', Auth::user()->id)->orderBy('id', 'asc')->paginate(16));
    }

    /**
     * Link to each users page when clicked.
     *
     * @param $id
     *
     * @return $this $data array with $user info and associated statuses
     */
    public function show($id) {
        if($id == Auth::user()->id) {
            return redirect('/profile');
        } else {
            $user_id  = User::findById($id);
            $statuses = User::findById($id)->status()->latest()->get();
            $data     = [
                'user_id'  => $user_id,
                'statuses' => $statuses,
                'followers' => User::followers($user_id)
            ];
            return view('pages.show')->with('data', $data);
        }
    }

}
