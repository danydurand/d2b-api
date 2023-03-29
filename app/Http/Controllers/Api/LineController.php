<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\LineStoreRequest;
use App\Http\Requests\Api\LineUpdateRequest;
use App\Http\Resources\Api\LineCollection;
use App\Http\Resources\Api\LineResource;
use App\Models\Line;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class LineController extends Controller
{
    public function index(Request $request): Response
    {
        $lines = Line::all();

        return new LineCollection($lines);
    }

    public function store(LineStoreRequest $request): Response
    {
        $line = Line::create($request->validated());

        return new LineResource($line);
    }

    public function show(Request $request, Line $line): Response
    {
        return new LineResource($line);
    }

    public function update(LineUpdateRequest $request, Line $line): Response
    {
        $line->update($request->validated());

        return new LineResource($line);
    }

    public function destroy(Request $request, Line $line): Response
    {
        $line->delete();

        return response()->noContent();
    }
}
