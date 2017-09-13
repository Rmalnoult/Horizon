<?php

namespace App\Http\Controllers;

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
        $topics = Topic::where('published', '=', 1)->get();
        // dd($topics->articles->toJson());
        foreach ($topics as $topic) {
            $response[] = [
                'id' => $topic->id,
                'title' => $topic->title,
                'image' => $topic->image,
                'active' => false,
                'edito' => $topic->edito,
                'articles' => $topic->articles->toArray(),
            ];
        }
        return view('home')->with('topics', $response);
    }
}
