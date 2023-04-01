<?php

namespace App\Http\Controllers\Api\V1;

use App\Filter\V1\ColourFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\ColourStoreRequest;
use App\Http\Requests\V1\ColourUpdateRequest;
use App\Http\Resources\V1\ColourCollection;
use App\Http\Resources\V1\ColourResource;
use App\Models\Colour;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ColourController extends Controller
{
    public function index(Request $request): ColourCollection
    {

        $filter = new ColourFilter();
        $filterItems = $filter->transform($request);

        $colours = Colour::where($filterItems);

        return new ColourCollection($colours->paginate()->appends($request->query()));

        // $colours = Line::paginate();
        // return new LineCollection($colours);
    }

    public function store(ColourStoreRequest $request): ColourResource
    {
        $colour = Colour::create($request->validated());

        return new ColourResource($colour);
    }

    public function show(Request $request, Colour $colour): ColourResource
    {
        return new ColourResource($colour);
    }

    public function update(ColourUpdateRequest $request, Colour $colour): ColourResource
    {
        $colour->update($request->validated());

        return new ColourResource($colour);
    }

    public function destroy(Request $request, Colour $colour)
    {
        $colour->delete();
        return response()->noContent();
    }
}
