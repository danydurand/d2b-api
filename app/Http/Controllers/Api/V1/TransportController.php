<?php

namespace App\Http\Controllers\Api\V1;

use App\Filter\V1\TransportFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\TransportStoreRequest;
use App\Http\Requests\V1\TransportUpdateRequest;
use App\Http\Resources\V1\TransportCollection;
use App\Http\Resources\V1\TransportResource;
use App\Models\Transport;
use App\Models\Line;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TransportController extends Controller
{
    public function index(Request $request): TransportCollection
    {

        $filter = new TransportFilter();
        $filterItems = $filter->transform($request);

        // $includeLines = $request->query('includeLines');

        $transports = Transport::where($filterItems);

        // if ($includeLines) {
        //     $transports->with('lines');
        // }
        return new TransportCollection($transports->paginate()->appends($request->query()));

        // $transports = Transport::paginate();
        // return new TransportCollection($transports);
    }

    public function store(TransportStoreRequest $request): TransportResource
    {
        $transport = Transport::create($request->validated());

        return new TransportResource($transport);
    }

    public function show(Request $request, Transport $transport): TransportResource
    {
        // $includeLines = $request->query('includeLines');

        // if ($includeLines) {
        //     $transport->loadMissing('lines');
        // }

        return new TransportResource($transport);
    }

    public function update(TransportUpdateRequest $request, Transport $transport): TransportResource
    {
        $transport->update($request->validated());

        return new TransportResource($transport);
    }

    public function destroy(Request $request, Transport $transport)
    {
        // $intRelaQnty = Line::where('Transport_id', $transport->id)->get()->count();
        // if ($intRelaQnty == 0) {
            $transport->delete();
            return response()->noContent();
        // } else {
        //     return response()->json(['errors' => 'There are ('. $intRelaQnty. ') Lines assigned to this Transport.'], 400);
        // }
    }
}
