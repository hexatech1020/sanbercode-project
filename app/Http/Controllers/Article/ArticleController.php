<?php

namespace App\Http\Controllers\Article;

use App\Models\Article\Article;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\ArticleResource;
use App\Http\Resources\ArticleCollection;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::paginate(2);
        return new ArticleCollection($articles);
        // return ArticleResource::collection($articles);
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
        $request->validate([
            'title' => ['required','min:3','max:255'],
            'body' => ['required'],
            'subject' => ['required'],
        ]);

        $articles = auth()->user()->articles()->create($this->articleStore());

        return $articles;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        // return response(['data' => [
        //     'status' => 'success',
        //     'article' => new ArticleResource($article),
        // ]]);
        return new ArticleResource($article);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {
        $article->update($this->articleStore());

        return new ArticleResource($article);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        $article->delete();

        return response()->json('The Article was deleted', 200);
    }

    public function articleStore(){
        return [
            'title' => request('title'),
            'slug' => \Str::slug(request('title')),
            'body' => request('body'),
            'subject_id' => request('subject'),
        ];
    }
}
