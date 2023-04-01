<?php

namespace App\Http\Controllers\Api\V1;

use App\Filter\V1\ProviderFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\ProviderStoreRequest;
use App\Http\Requests\V1\ProviderUpdateRequest;
use App\Http\Resources\V1\ProviderCollection;
use App\Http\Resources\V1\ProviderResource;
use App\Models\Provider;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProviderController extends Controller
{
    public function index(Request $request): ProviderCollection
    {

        $filter = new ProviderFilter();
        $filterItems = $filter->transform($request);

        $providers = Provider::where($filterItems);

        return new ProviderCollection($providers->paginate()->appends($request->query()));

        // $providers = Line::paginate();
        // return new LineCollection($providers);
    }

    public function store(ProviderStoreRequest $request): ProviderResource
    {
        $provider = Provider::create($request->validated());

        return new ProviderResource($provider);
    }

    public function show(Request $request, Provider $provider): ProviderResource
    {
        return new ProviderResource($provider);
    }

    public function update(ProviderUpdateRequest $request, Provider $provider): ProviderResource
    {
        $provider->update($request->validated());

        return new ProviderResource($provider);
    }

    public function destroy(Request $request, Provider $provider)
    {
        $provider->delete();
        return response()->noContent();
    }
}
