<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\SubLineStoreRequest;
use App\Http\Requests\Api\SubLineUpdateRequest;
use App\Http\Resources\Api\SubLineCollection;
use App\Http\Resources\Api\SubLineResource;
use App\Models\SubLine;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SubLineController extends Controller
{
    public function index(Request $request): Response
    {
        $subLines = SubLine::all();

        return new SubLineCollection($subLines);
    }

    public function store(SubLineStoreRequest $request): Response
    {
        $subLine = SubLine::create($request->validated());

        return new SubLineResource($subLine);
    }

    public function show(Request $request, SubLine $subLine): Response
    {
        return new SubLineResource($subLine);
    }

    public function update(SubLineUpdateRequest $request, SubLine $subLine): Response
    {
        $subLine->update($request->validated());

        return new SubLineResource($subLine);
    }

    public function destroy(Request $request, SubLine $subLine): Response
    {
        $subLine->delete();

        return response()->noContent();
    }
}
