<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $articles = $user->articles;
        return view('articles.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('articles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'content' => 'required',
            'category' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $article = new Article();
        $article->title = $validatedData['title'];
        $article->content = $validatedData['content'];
        $article->category = $validatedData['category'];
        $article->user_id = Auth::id();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $imagePath = $image->store('public/images');
            $article->image = basename($imagePath);
        }
        $article->save();
        return redirect()->route('articles.index')->with('success', 'Article success created.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        $comments = $article->comments;
        return view('articles.show', compact('article','comments'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        return view('articles.edit', compact('article'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Article $article)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'content' => 'required',
            'category' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $article->title = $validatedData['title'];
        $article->content = $validatedData['content'];
        $article->category = $validatedData['category'];

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = $image->store('public/images');
            $article->image = basename($imagePath);
        }

        $article->save();

        return redirect()->route('articles.show', $article)->with('success', 'Article successful updated.');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        $article->delete();

        return redirect()->route('articles.index')->with('success', 'Article successful deleted.');
    }

    //Comments

    public function storeComment(Request $request, Article $article){
        $request->validate([
            'content'=>'required'
        ]);

        $comment = new Comment();
        $comment->author = Auth::user()->name;
        $comment->content = $request->input('content');

        $article->comments()->save($comment);
        return redirect()->route('articles.show',$article);
    }

    public function destroyComment(Article $article, Comment $comment){
        $comment->delete();
        return redirect()->route('articles.show',$article);
    }
}

