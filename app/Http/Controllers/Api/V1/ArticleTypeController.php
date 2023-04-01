<?php

namespace App\Http\Controllers\Api\V1;

use App\Filter\V1\ArticleTypeFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\ArticleTypeStoreRequest;
use App\Http\Requests\V1\ArticleTypeUpdateRequest;
use App\Http\Resources\V1\ArticleTypeCollection;
use App\Http\Resources\V1\ArticleTypeResource;
use App\Models\ArticleType;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ArticleTypeController extends Controller
{
    public function index(Request $request): ArticleTypeCollection
    {

        $filter = new ArticleTypeFilter();
        $filterItems = $filter->transform($request);

        $articleTypes = ArticleType::where($filterItems);

        return new ArticleTypeCollection($articleTypes->paginate()->appends($request->query()));

        // $articleTypes = Line::paginate();
        // return new LineCollection($articleTypes);
    }

    public function store(ArticleTypeStoreRequest $request): ArticleTypeResource
    {
        $articleType = ArticleType::create($request->validated());

        return new ArticleTypeResource($articleType);
    }

    public function show(Request $request, ArticleType $articleType): ArticleTypeResource
    {
        return new ArticleTypeResource($articleType);
    }

    public function update(ArticleTypeUpdateRequest $request, ArticleType $articleType): ArticleTypeResource
    {
        $articleType->update($request->validated());

        return new ArticleTypeResource($articleType);
    }

    public function destroy(Request $request, ArticleType $articleType)
    {
        $articleType->delete();
        return response()->noContent();
    }
}
