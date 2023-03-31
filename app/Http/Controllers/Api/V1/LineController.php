<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\LineStoreRequest;
use App\Http\Requests\V1\LineUpdateRequest;
use App\Http\Resources\V1\LineCollection;
use App\Http\Resources\V1\LineResource;
use App\Filter\V1\LineFilter;
use App\Models\Line;
use App\Models\SubLine;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class LineController extends Controller
{
    public function index(Request $request): LineCollection
    {

        $filter = new LineFilter();
        $filterItems = $filter->transform($request);

        // $includeSubLines = $request->query('includeSubLines');

        $lines = Line::where($filterItems);

        // if ($includeSubLines) {
        //     $lines->with('subLines');
        // }
        return new LineCollection($lines->paginate()->appends($request->query()));

        // $lines = Line::paginate();
        // return new LineCollection($lines);
    }

    public function store(LineStoreRequest $request): LineResource
    {
        $line = Line::create($request->validated());

        return new LineResource($line);
    }

    public function show(Request $request, Line $line): LineResource
    {
        // $includeSubLines = $request->query('includeSubLines');

        // if ($includeSubLines) {
        //     $line->loadMissing('subLines');
        // }

        return new LineResource($line);
    }

    public function update(LineUpdateRequest $request, Line $line): LineResource
    {
        $line->update($request->validated());

        return new LineResource($line);
    }

    public function destroy(Request $request, Line $line)
    {
        $intRelaQnty = SubLine::where('line_id', $line->id)->get()->count();
        if ($intRelaQnty == 0) {
            $line->delete();
            return response()->noContent();
        } else {
            return response()->json(['errors' => 'There are ('. $intRelaQnty. ') SubLines assigned to this Line.'], 400);
        }
    }
}
