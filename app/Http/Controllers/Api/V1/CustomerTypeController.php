<?php

namespace App\Http\Controllers\Api\V1;

use App\Filter\V1\CustomerTypeFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\CustomerTypeStoreRequest;
use App\Http\Requests\V1\CustomerTypeUpdateRequest;
use App\Http\Resources\V1\CustomerTypeCollection;
use App\Http\Resources\V1\CustomerTypeResource;
use App\Models\CustomerType;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CustomerTypeController extends Controller
{
    public function index(Request $request): CustomerTypeCollection
    {
        $filter = new CustomerTypeFilter();
        $filterItems = $filter->transform($request);

        $includeCustomers = $request->query('includeCustomers');

        $customerTypes = CustomerType::where($filterItems);

        if ($includeCustomers) {
            $customerTypes->with('customers');
        }
        return new CustomerTypeCollection($customerTypes->paginate()->appends($request->query()));

        // $customerTypes = CustomerType::paginate();
        // return new CustomerTypeCollection($customerTypes);
    }

    public function store(CustomerTypeStoreRequest $request): CustomerTypeResource
    {
        $customerType = CustomerType::create($request->validated());

        return new CustomerTypeResource($customerType);
    }

    public function show(Request $request, CustomerType $customerType): CustomerTypeResource
    {
        return new CustomerTypeResource($customerType);
    }

    public function update(CustomerTypeUpdateRequest $request, CustomerType $customerType): CustomerTypeResource
    {
        $customerType->update($request->validated());

        return new CustomerTypeResource($customerType);
    }

    public function destroy(Request $request, CustomerType $customerType): Response
    {
        $customerType->delete();

        return response()->noContent();
    }
}
