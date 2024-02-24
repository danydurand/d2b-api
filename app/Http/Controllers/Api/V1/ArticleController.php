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
use Illuminate\Support\Carbon;

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

    public function storeMultiple(Request $request)
    {
        $resquesData = $request->all();

        $loop = 0;
        foreach ($resquesData['articles'] as $key => $value) {
            Article::create([
                'code'             => $value['code'],
                'description'      => $value['description'],
                'business_id'      => $value['businessId'],
                'brand_id'         => $value['brandId'],
                'sub_brand_id'     => $value['subBrandId'],
                'category_id'      => $value['categoryId'],
                'line_id'          => $value['lineId'],
                'sub_line_id'      => $value['subLineId'],
                'colour_id'        => $value['colourId'],
                'origin_id'        => $value['originId'],
                'article_type_id'  => $value['articleTypeId'],
                'provider_id'      => $value['providerId'],
                'sale_unit_id'     => $value['saleUnitId'],
                'ssale_unit_id'    => $value['ssaleUnitId'],
                'reference'        => $value['reference'],
                'model'            => $value['model'],
                // 'comments'         => $value['comments'],
                // 'compose'          => $value['compose'],
                // 'picture'          => $value['picture'],
                // 'field1'           => $value['field1'],
                // 'field2'           => $value['field2'],
                // 'field3'           => $value['field3'],
                // 'field4'           => $value['field4'],
                // 'field5'           => $value['field5'],
                // 'x_11'             => $value['x_11'],
                // 'x_12'             => $value['x_12'],
                // 'weight'           => $value['weight'],
                // 'feet'             => $value['feet'],
                // 'sale_price1'      => $value['sale_price1'],
                // 'sale_price2'      => $value['sale_price2'],
                // 'sale_price3'      => $value['sale_price3'],
                // 'sale_price4'      => $value['sale_price4'],
                // 'sale_price5'      => $value['sale_price5'],
                // 'last_date_price1' => $value['last_date_price1'],
                // 'last_date_price2' => $value['last_date_price2'],
                // 'last_date_price3' => $value['last_date_price3'],
                // 'last_date_price4' => $value['last_date_price4'],
                // 'last_date_price5' => $value['last_date_price5'],
                // 'real_stock'       => $value['real_stock'],
                // 'commited_stock'   => $value['commited_stock'],
                // 'comming_stock'    => $value['comming_stock'],
                // 'dispatch_stock'   => $value['dispatch_stock'],
                // 'sreal_stock'      => $value['sreal_stock'],
                // 'scommited_stock'  => $value['scommited_stock'],
                // 'scomming_stock'   => $value['scomming_stock'],
                // 'sdispatch_stock'  => $value['sdispatch_stock'],
                // 'margin1'          => $value['margin1'],
                // 'margin2'          => $value['margin2'],
                // 'margin3'          => $value['margin3'],
                // 'margin4'          => $value['margin4'],
                // 'margin5'          => $value['margin5'],
                'must_be_sync'     => false,
                'sync_at'          => Carbon::now(),
                'created_by'       => 1,
                'updated_by'       => 1,
            ]);
            $loop++;
        }

        return response()->json(['message' => $loop.' article(s) created successfully ']);
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
