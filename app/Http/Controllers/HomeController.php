<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $posts = Post::when(isset(request()->search),function ($query){
            $search = request()->search;
            $query->where('title',"LIKE","%$search%")
                ->orWhere('description',"LIKE","%$search%");

        })->latest('id')->paginate(5);
        return view('post.index',compact('posts'));
//            return config('my.gf');
    }

}
