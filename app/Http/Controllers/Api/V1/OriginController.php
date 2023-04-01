<?php

namespace App\Http\Controllers\Api\V1;

use App\Filter\V1\OriginFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\OriginStoreRequest;
use App\Http\Requests\V1\OriginUpdateRequest;
use App\Http\Resources\V1\OriginCollection;
use App\Http\Resources\V1\OriginResource;
use App\Models\Origin;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class OriginController extends Controller
{
    public function index(Request $request): OriginCollection
    {

        $filter = new OriginFilter();
        $filterItems = $filter->transform($request);

        $origins = Origin::where($filterItems);

        return new OriginCollection($origins->paginate()->appends($request->query()));

        // $origins = Line::paginate();
        // return new LineCollection($origins);
    }

    public function store(OriginStoreRequest $request): OriginResource
    {
        $origin = Origin::create($request->validated());

        return new OriginResource($origin);
    }

    public function show(Request $request, Origin $origin): OriginResource
    {
        return new OriginResource($origin);
    }

    public function update(OriginUpdateRequest $request, Origin $origin): OriginResource
    {
        $origin->update($request->validated());

        return new OriginResource($origin);
    }

    public function destroy(Request $request, Origin $origin)
    {
        $origin->delete();
        return response()->noContent();
    }
}
