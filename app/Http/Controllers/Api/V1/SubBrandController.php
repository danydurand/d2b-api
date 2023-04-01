<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\SubBrandStoreRequest;
use App\Http\Requests\V1\SubBrandUpdateRequest;
use App\Http\Resources\V1\SubBrandCollection;
use App\Http\Resources\V1\SubBrandResource;
use App\Filter\V1\SubBrandFilter;
use App\Models\SubBrand;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SubBrandController extends Controller
{
    public function index(Request $request): SubBrandCollection
    {

        $filter = new SubBrandFilter();
        $filterItems = $filter->transform($request);

        $subBrands = SubBrand::where($filterItems);

        return new SubBrandCollection($subBrands->paginate()->appends($request->query()));

        // $subBrands = Line::paginate();
        // return new LineCollection($subBrands);
    }

    public function store(SubBrandStoreRequest $request): SubBrandResource
    {
        $subBrand = SubBrand::create($request->validated());

        return new SubBrandResource($subBrand);
    }

    public function show(Request $request, SubBrand $subBrand): SubBrandResource
    {
        return new SubBrandResource($subBrand);
    }

    public function update(SubBrandUpdateRequest $request, SubBrand $subBrand): SubBrandResource
    {
        $subBrand->update($request->validated());

        return new SubBrandResource($subBrand);
    }

    public function destroy(Request $request, SubBrand $subBrand)
    {
        $subBrand->delete();
        return response()->noContent();
    }
}
