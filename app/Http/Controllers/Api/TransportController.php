<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\TransportStoreRequest;
use App\Http\Requests\Api\TransportUpdateRequest;
use App\Http\Resources\Api\TransportCollection;
use App\Http\Resources\Api\TransportResource;
use App\Models\Transport;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TransportController extends Controller
{
    public function index(Request $request): Response
    {
        $transports = Transport::all();

        return new TransportCollection($transports);
    }

    public function store(TransportStoreRequest $request): Response
    {
        $transport = Transport::create($request->validated());

        return new TransportResource($transport);
    }

    public function show(Request $request, Transport $transport): Response
    {
        return new TransportResource($transport);
    }

    public function update(TransportUpdateRequest $request, Transport $transport): Response
    {
        $transport->update($request->validated());

        return new TransportResource($transport);
    }

    public function destroy(Request $request, Transport $transport): Response
    {
        $transport->delete();

        return response()->noContent();
    }
}
