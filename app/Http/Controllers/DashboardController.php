<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\user;
class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id= Auth::user()->id;
        $user = User::find($user_id);
        $post = $user->post;
        $data = array(
            'user' => $user,
            'post' => $post,
            'user_id' => $user_id
        );
        return view('dashboard')->with($data);

        // 
        // return view('dashboard')->with('post', $post);
    }
}
