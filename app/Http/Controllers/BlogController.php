<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Post;
use \App\Category;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     *
     */

    protected $limit = 3;
    public function index()
    {
        /*\DB::enableQueryLog();
        $posts = Post::with('author')->get();
        //$posts = Post::all();
        view('blog.index', compact('posts'))->render();

        dd(\DB::getQueryLog());*/
        //$posts = Post::with('author')->orderBy('created_at', 'desc')->get();
        //$posts = Post::with('author')->latest()->get();
        $categories = Category::with(['posts' => function($query) {
            $query->published();
        }])->orderBy('title', 'asc')->get();

        $posts = Post::with('author')->latestFirst()->published()->paginate($this->limit); //simplepagenate()
        return view('blog.index', compact('posts', 'categories'));
    }

    public function category($id)
    {
        $categories = Category::with(['posts' => function($query) {
            $query->published();
        }])->orderBy('title', 'asc')->get();

        $posts = Post::with('author')->latestFirst()->published()
            ->where('category_id', $id)
            ->paginate($this->limit); //simplepagenate()
        return view('blog.index', compact('posts', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //$post = Post::published()->findOrFail($id); added RouteServiceProvider
        return view('blog.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
