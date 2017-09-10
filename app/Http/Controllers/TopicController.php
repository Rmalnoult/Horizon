<?php

namespace App\Http\Controllers;

use App\Topic;
use App\Article;
use Illuminate\Http\Request;

class TopicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('topics.index')->with('topics', Topic::paginate(25));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('topics.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|unique:topics,title',
            'edito' => 'string',
        ]);

        $topic = Topic::create([
            'title' => $request->title,
            'edito' => $request->edito,
            'published' => $request->published ? true : false,
        ]);

        return redirect('/topics/'.$topic->id.'/edit');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function show(Topic $topic)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function edit(Topic $topic)
    {
        return view('topics.update')->with(['topic' => $topic]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Topic $topic)
    {
        $this->validate($request, [
            'title' => 'string',
            'edito' => 'string',
        ]);

        $topic->title = $request->title;
        $topic->edito = $request->edito;
        $topic->published = $request->published ? true : false;

        $request->articles = json_decode($request->encodedArticles);
        foreach ($request->articles as $a) {
            if (!$a->id) {
                // dd('new article');
                $article = Article::create([
                    'topic_id' => $topic->id,
                    'title' => $a->title,
                    'source' => $a->source,
                    'url' => $a->url,
                    'image' => $a->image,
                    'excerpt' => $a->excerpt,
                ]);
            }
        }
        return redirect('/topics');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function destroy(Topic $topic)
    {
        //
    }
}
