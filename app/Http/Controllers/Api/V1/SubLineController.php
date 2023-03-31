<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\SubLineStoreRequest;
use App\Http\Requests\V1\SubLineUpdateRequest;
use App\Http\Resources\V1\SubLineCollection;
use App\Http\Resources\V1\SubLineResource;
use App\Filter\V1\SubLineFilter;
use App\Models\SubLine;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SubLineController extends Controller
{
    public function index(Request $request): SubLineCollection
    {

        $filter = new SubLineFilter();
        $filterItems = $filter->transform($request);

        $subLines = SubLine::where($filterItems);

        return new SubLineCollection($subLines->paginate()->appends($request->query()));

        // $subLines = Line::paginate();
        // return new LineCollection($subLines);
    }

    public function store(SubLineStoreRequest $request): SubLineResource
    {
        $subLine = SubLine::create($request->validated());

        return new SubLineResource($subLine);
    }

    public function show(Request $request, SubLine $subLine): SubLineResource
    {
        return new SubLineResource($subLine);
    }

    public function update(SubLineUpdateRequest $request, SubLine $subLine): SubLineResource
    {
        $subLine->update($request->validated());

        return new SubLineResource($subLine);
    }

    public function destroy(Request $request, SubLine $subLine)
    {
        $subLine->delete();
        return response()->noContent();
    }
}
