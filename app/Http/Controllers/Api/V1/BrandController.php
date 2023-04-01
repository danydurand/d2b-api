<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\BrandStoreRequest;
use App\Http\Requests\V1\BrandUpdateRequest;
use App\Http\Resources\V1\BrandCollection;
use App\Http\Resources\V1\BrandResource;
use App\Filter\V1\BrandFilter;
use App\Models\Brand;
use App\Models\SubBrand;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BrandController extends Controller
{
    public function index(Request $request): BrandCollection
    {

        $filter = new BrandFilter();
        $filterItems = $filter->transform($request);

        $includeSubBrands = $request->query('includeSubBrands');

        $brands = Brand::where($filterItems);

        if ($includeSubBrands) {
            $brands->with('subBrands');
        }
        return new BrandCollection($brands->paginate()->appends($request->query()));

        // $brands = Brand::paginate();
        // return new BrandCollection($brands);
    }

    public function store(BrandStoreRequest $request): BrandResource
    {
        $brand = Brand::create($request->validated());

        return new BrandResource($brand);
    }

    public function show(Request $request, Brand $brand): BrandResource
    {
        $includeSubBrands = $request->query('includeSubBrands');

        if ($includeSubBrands) {
            $brand->loadMissing('subBrands');
        }

        return new BrandResource($brand);
    }

    public function update(BrandUpdateRequest $request, Brand $brand): BrandResource
    {
        $brand->update($request->validated());

        return new BrandResource($brand);
    }

    public function destroy(Request $request, Brand $brand)
    {
        $intRelaQnty = SubBrand::where('brand_id', $brand->id)->get()->count();
        if ($intRelaQnty == 0) {
            $brand->delete();
            return response()->noContent();
        } else {
            return response()->json(['errors' => 'There are ('. $intRelaQnty. ') SubBrands assigned to this Brand.'], 400);
        }
    }
}
