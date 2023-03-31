<?php

namespace App\Http\Controllers\Api\V1;

use App\Filter\V1\CategoryFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\CategoryStoreRequest;
use App\Http\Requests\V1\CategoryUpdateRequest;
use App\Http\Resources\V1\CategoryCollection;
use App\Http\Resources\V1\CategoryResource;
use App\Models\Category;
use App\Models\Line;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CategoryController extends Controller
{
    public function index(Request $request): CategoryCollection
    {

        $filter = new CategoryFilter();
        $filterItems = $filter->transform($request);

        $includeLines = $request->query('includeLines');

        $categorys = Category::where($filterItems);

        if ($includeLines) {
            $categorys->with('lines');
        }
        return new CategoryCollection($categorys->paginate()->appends($request->query()));

        // $categorys = Category::paginate();
        // return new CategoryCollection($categorys);
    }

    public function store(CategoryStoreRequest $request): CategoryResource
    {
        $category = Category::create($request->validated());

        return new CategoryResource($category);
    }

    public function show(Request $request, Category $category): CategoryResource
    {
        $includeLines = $request->query('includeLines');

        if ($includeLines) {
            $category->loadMissing('lines');
        }

        return new CategoryResource($category);
    }

    public function update(CategoryUpdateRequest $request, Category $category): CategoryResource
    {
        $category->update($request->validated());

        return new CategoryResource($category);
    }

    public function destroy(Request $request, Category $category)
    {
        $intRelaQnty = Line::where('category_id', $category->id)->get()->count();
        if ($intRelaQnty == 0) {
            $category->delete();
            return response()->noContent();
        } else {
            return response()->json(['errors' => 'There are ('. $intRelaQnty. ') Lines assigned to this Category.'], 400);
        }
    }
}
