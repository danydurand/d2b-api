<?php

namespace App\Http\Controllers\Api\V1;

use App\Filter\V1\ArticleFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\ArticleBulkStoreRequest;
use App\Http\Requests\V1\ArticleStoreRequest;
use App\Http\Requests\V1\ArticleUpdateRequest;
use App\Http\Resources\V1\ArticleCollection;
use App\Http\Resources\V1\ArticleResource;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;
use Illuminate\Support\Arr;


/**
* @OA\Info(
*             title="D2B Api Docs",
*             version="1.0",
*             description="API Endpoints for Articles"
* )
*
* @OA\Server(url="http://localhost:8000")
*/

class ArticleController extends Controller
{
    /**
     * List of Articles
     * @OA\Get (
     *     path="api/v1/article",
     *     tags={"Articles"},
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 type="array",
     *                 property="rows",
     *                 @OA\Items(
     *                     type="object",
     *                     @OA\Property(
     *                         property="id",
     *                         type="number",
     *                         example="1"
     *                     ),
     *                     @OA\Property(
     *                         property="code",
     *                         type="string",
     *                         example="290312"
     *                     ),
     *                     @OA\Property(
     *                         property="description",
     *                         type="string",
     *                         example="ALICATE DE PRESION"
     *                     ),
     *                     @OA\Property(
     *                         property="created_at",
     *                         type="string",
     *                         example="2023-02-23T00:09:16.000000Z"
     *                     ),
     *                     @OA\Property(
     *                         property="updated_at",
     *                         type="string",
     *                         example="2023-02-23T12:33:45.000000Z"
     *                     )
     *                 )
     *             )
     *         )
     *     )
     * )
     */
    public function index(Request $request): ArticleCollection
    {

        $filter = new ArticleFilter();
        $filterItems = $filter->transform($request);

        $articles = Article::where($filterItems);

        return new ArticleCollection($articles->paginate()->appends($request->query()));

    }

    public function store(ArticleStoreRequest $request): ArticleResource
    {

        $article = Article::create($request->all());

        return new ArticleResource($article);
    }

    public function bulkStore(ArticleBulkStoreRequest $request)
    {
        $bulk = collect($request->all())->map(function ($arr, $key) {
            return Arr::except($arr, [
                'brandId',
                'subBrandId',
                'categoryId',
                'lineId',
                'subLineId',
                'colourId',
                'saleUnitId',
                'ssaleUnitId',
                'salePrice1',
                'salePrice2',
                'salePrice3',
                'salePrice4',
                'salePrice5',
                'lastDatePrice1',
                'lastDatePrice2',
                'lastDatePrice3',
                'lastDatePrice4',
                'lastDatePrice5',
                'realStock',
                'commitedStock',
                'commingStock',
                'srealStock',
                'scommitedStock',
                'mustBeSync',
                'syncAt',
                'createdBy',
                'updatedBy'
            ]);
        });

        Article::insert($bulk->toArray());
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
