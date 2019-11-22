<?php namespace App\Http\Controllers;

use App\User;
use App\Http\Requests;
use App\Http\Requests\SettingsRequest;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;

class PagesController extends Controller {

    /**
     * Public Home Page
     *
     */
    public function home() {
        if (Auth::check()) {
            return redirect('/newsfeed');
        } else {
            return view('pages.home');
        }
    }

    /**
     * Profile Page
     *
     */
    public function profile() {

        $data = [
            'statuses'  => Auth::user()->status()->latest()->get(),
            'followers' => User::followers(Auth::user())
        ];
        return view('pages.profile')
            ->with('data', $data);
    }

    /**
     * Settings Page
     *
     */
    public function settings() {
        return view('pages.settings');
    }

    public function update_settings(SettingsRequest $request) {
        // Get all the inputs
        $input = Input::all();

        // Get the Authenticated user
        $user = Auth::user();

        // Update DB fields
        $user->name     = $input['name'];
        $user->email    = $input['email'];
        $user->website  = $input['website'];
        $user->location = $input['location'];
        $user->save();

        return redirect('/settings')->with('message', 'Your settings have been saved!');
    }

    /**
     * About Page
     *
     */
    public function about() {
        return view('pages.about');
    }
}
