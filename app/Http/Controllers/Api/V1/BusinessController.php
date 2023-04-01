<?php

namespace App\Http\Controllers\Api\V1;

use App\Filter\V1\BusinessFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\BusinessStoreRequest;
use App\Http\Requests\V1\BusinessUpdateRequest;
use App\Http\Resources\V1\BusinessCollection;
use App\Http\Resources\V1\BusinessResource;
use App\Models\Business;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BusinessController extends Controller
{
    public function index(Request $request): BusinessCollection
    {

        $filter = new BusinessFilter();
        $filterItems = $filter->transform($request);

        $businesss = Business::where($filterItems);

        return new BusinessCollection($businesss->paginate()->appends($request->query()));

        // $businesss = Line::paginate();
        // return new LineCollection($businesss);
    }

    public function store(BusinessStoreRequest $request): BusinessResource
    {
        $business = Business::create($request->validated());

        return new BusinessResource($business);
    }

    public function show(Request $request, Business $business): BusinessResource
    {
        return new BusinessResource($business);
    }

    public function update(BusinessUpdateRequest $request, Business $business): BusinessResource
    {
        $business->update($request->validated());

        return new BusinessResource($business);
    }

    public function destroy(Request $request, Business $business)
    {
        $business->delete();
        return response()->noContent();
    }
}
