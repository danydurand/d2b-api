<?php

namespace App\Http\Controllers\Api\V1;

use App\Filter\V1\CustomerFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\CustomerStoreRequest;
use App\Http\Requests\V1\CustomerUpdateRequest;
use App\Http\Resources\V1\CustomerCollection;
use App\Http\Resources\V1\CustomerResource;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CustomerController extends Controller
{
    public function index(Request $request): CustomerCollection
    {

        $filter = new CustomerFilter();
        $filterItems = $filter->transform($request);

        // $includeCustomerTypes = $request->query('includeCustomers');

        $customers = Customer::where($filterItems);

        // if ($includeCustomerTypes) {
        //     $customers->with('customers');
        // }
        return new CustomerCollection($customers->paginate()->appends($request->query()));

        // $customers = Customer::paginate();
        // return new CustomerCollection($customers);
    }

    public function store(CustomerStoreRequest $request): CustomerResource
    {
        $customer = Customer::create($request->validated());

        return new CustomerResource($customer);
    }

    public function show(Request $request, Customer $customer): CustomerResource
    {
        // $includeCustomerTypes = $request->query('includeCustomers');

        // if ($includeCustomerTypes) {
        //     $customer->loadMissing('customers');
        // }

        return new CustomerResource($customer);
    }

    public function update(CustomerUpdateRequest $request, Customer $customer): CustomerResource
    {
        $customer->update($request->validated());

        return new CustomerResource($customer);
    }

    public function destroy(Request $request, Customer $customer)
    {
        // $intCustQnty = Customer::where('Customer_id', $customer->id)->get()->count();
        // if ($intCustQnty == 0) {
            $customer->delete();
            return response()->noContent();
        // } else {
        //     return response()->json(['errors' => 'There are ('. $intCustQnty. ') customers assigned to this Customer.'], 400);
        // }
    }
}
