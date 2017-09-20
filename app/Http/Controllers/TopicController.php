<?php

namespace App\Http\Controllers;

use App\Topic;
use App\Article;
use App\Category;
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
        $categories = Category::pluck('id', 'name');
        return view('topics.create')->with('categories', $categories);
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
            'image' => 'string',
            'category' => 'integer',
            'edito' => 'string',
        ]);

        $topic = Topic::create([
            'title' => $request->title,
            'edito' => $request->edito,
            'category_id' => $request->category,
            'image' => $request->image,
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
        $categories = Category::pluck('id', 'name');
        return view('topics.update')->with(['topic' => $topic, 'categories' => $categories]);
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
            'image' => 'string',
            'category' => 'integer',
        ]);

        $topic->title = $request->title;
        $topic->category_id = $request->category;
        $topic->edito = $request->edito;
        $topic->image = $request->image;
        $topic->published = $request->published ? true : false;

        $request->articles = json_decode($request->encodedArticles);
            // dd($request->articles);
        foreach ($request->articles as $a) {
            if (!$a->id) {
                $article = Article::create([
                    'topic_id' => $topic->id,
                    'title' => $a->title,
                    'source' => $a->source,
                    'url' => $a->url,
                    'type' => $a->type,
                    'image' => $a->image,
                    'excerpt' => $a->excerpt,
                ]);
            } else {
                $article = Article::find($a->id);
                $article->title = $a->title;
                $article->source = $a->source;
                $article->url = $a->url;
                $article->type = $a->type;
                $article->image = $a->image;
                $article->excerpt = $a->excerpt;
                $article->save();
            }
        }

        $topic->save();
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
