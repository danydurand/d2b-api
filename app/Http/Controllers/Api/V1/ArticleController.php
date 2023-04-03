<?php

namespace App\Http\Controllers\Api\V1;

use App\Filter\V1\ArticleFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\ArticleStoreRequest;
use App\Http\Requests\V1\ArticleUpdateRequest;
use App\Http\Resources\V1\ArticleCollection;
use App\Http\Resources\V1\ArticleResource;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ArticleController extends Controller
{
    public function index(Request $request): ArticleCollection
    {

        $filter = new ArticleFilter();
        $filterItems = $filter->transform($request);

        $articles = Article::where($filterItems);

        return new ArticleCollection($articles->paginate()->appends($request->query()));

        // $articles = Line::paginate();
        // return new LineCollection($articles);
    }

    public function store(ArticleStoreRequest $request): ArticleResource
    {
        $article = Article::create($request->validated());

        return new ArticleResource($article);
    }

    public function show(Request $request, Article $article): ArticleResource
    {
        return new ArticleResource($article);
    }

    public function update(ArticleUpdateRequest $request, Article $article): ArticleResource
    {
        $article->update($request->validated());

        return new ArticleResource($article);
    }

    public function destroy(Request $request, Article $article)
    {
        $article->delete();
        return response()->noContent();
    }
}
