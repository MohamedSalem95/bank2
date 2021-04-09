<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Group;
use App\Models\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index() {
        $group_count = Group::count();
        return view('home', ['group_count' => $group_count]);
    }

    public function profile($id){
        $user = User::findOrFail($id);
        return view('profile', ['user' => $user]);
    }
}
