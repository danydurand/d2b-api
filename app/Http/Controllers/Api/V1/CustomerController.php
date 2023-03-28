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

        $Customers = Customer::where($filterItems);

        // if ($includeCustomerTypes) {
        //     $Customers->with('customers');
        // }
        return new CustomerCollection($Customers->paginate()->appends($request->query()));

        // $Customers = Customer::paginate();
        // return new CustomerCollection($Customers);
    }

    public function store(CustomerStoreRequest $request): CustomerResource
    {
        $Customer = Customer::create($request->validated());

        return new CustomerResource($Customer);
    }

    public function show(Request $request, Customer $Customer): CustomerResource
    {
        // $includeCustomerTypes = $request->query('includeCustomers');

        // if ($includeCustomerTypes) {
        //     $Customer->loadMissing('customers');
        // }

        return new CustomerResource($Customer);
    }

    public function update(CustomerUpdateRequest $request, Customer $Customer): CustomerResource
    {
        $Customer->update($request->validated());

        return new CustomerResource($Customer);
    }

    public function destroy(Request $request, Customer $Customer)
    {
        // $intCustQnty = Customer::where('Customer_id', $Customer->id)->get()->count();
        // if ($intCustQnty == 0) {
            $Customer->delete();
            return response()->noContent();
        // } else {
        //     return response()->json(['errors' => 'There are ('. $intCustQnty. ') customers assigned to this Customer.'], 400);
        // }
    }
}
