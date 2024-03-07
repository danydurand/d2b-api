<?php

namespace App\Http\Controllers\Api\V1;

use App\Filter\V1\CustomerFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\CustomerBulkStoreRequest;
use App\Http\Requests\V1\CustomerStoreRequest;
use App\Http\Requests\V1\CustomerUpdateRequest;
use App\Http\Resources\V1\CustomerCollection;
use App\Http\Resources\V1\CustomerResource;
use App\Models\Customer;
use Arr;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;

class CustomerController extends Controller
{
    public function index(Request $request): CustomerCollection
    {

        $filter = new CustomerFilter();
        $filterItems = $filter->transform($request);

        $customers = Customer::where($filterItems);

        return new CustomerCollection($customers->paginate()->appends($request->query()));

    }

    public function store(CustomerStoreRequest $request): CustomerResource
    {
        $customer = Customer::create($request->all());

        return new CustomerResource($customer);
    }

    public function bulkStore(CustomerBulkStoreRequest $request)
    {
        $bulk = collect($request->all())->map(function ($arr, $key) {
            return Arr::except($arr, [
                'fiscalNumber',
                'businessName',
                'customerTypeId',
                'sellerId',
                'fiscalAddress',
                'dispatchAddress',
                'contactName',
                'mustBeSync',
                'syncAt',
                'createdBy'
            ]);
        });

        info('Bulk Store Customer: '.print_r($bulk->toArray(), true));

        Customer::insert($bulk->toArray());
    }

    public function show(Request $request, Customer $customer): CustomerResource
    {

        return new CustomerResource($customer);
    }

    public function update(CustomerUpdateRequest $request, Customer $customer)
    {

        $customer->update($request->all());

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
