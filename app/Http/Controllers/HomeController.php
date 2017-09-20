<?php

namespace App\Http\Controllers;

use App\Category;
use App\Topic;
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
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $paginatedTopics = Topic::where('published', '=', 1)->paginate(25);
        $categories = Category::has('topics')->with('topics')->get()->toJSON();
        return view('home')->with('categories', $categories);
    }
}
