<?php

namespace App\Http\Controllers\Api\V1;

use App\Filter\V1\SellerFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\SellerStoreRequest;
use App\Http\Requests\V1\SellerUpdateRequest;
use App\Http\Resources\V1\SellerCollection;
use App\Http\Resources\V1\SellerResource;
use App\Models\Customer;
use App\Models\Seller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;

class SellerController extends Controller
{
    public function index(Request $request): SellerCollection
    {

        $filter = new SellerFilter();
        $filterItems = $filter->transform($request);

        $includeCustomers = $request->query('includeCustomers');

        $sellers = Seller::where($filterItems);

        if ($includeCustomers) {
            $sellers->with('customers');
        }
        return new SellerCollection($sellers->paginate()->appends($request->query()));

        // $sellers = Seller::paginate();
        // return new SellerCollection($sellers);
    }

    public function storeMultiple(Request $request)
    {
        $requestData = $request->all();

        $loop = 0;
        foreach ($requestData['sellers'] as $key => $value) {
            Customer::create([
                'name'               => $value['name'],
                'sales_commission'   => $value['salesCommision'],
                'collect_commission' => $value['collectCommision'],
                'login'              => $value['login'],
                'password'           => \Hash::make('password'),
                'sync_at'            => Carbon::now(),
                'created_by'         => 1,
                'updated_by'         => 1,
            ]);
            $loop++;
        }

        return response()->json(['message' => $loop.' seller(s) created successfully ']);
    }

    public function store(SellerStoreRequest $request): SellerResource
    {
        info('Store');
        $seller = Seller::create($request->validated());
        info('Created');
        return new SellerResource($seller);
    }

    public function show(Request $request, Seller $seller): SellerResource
    {
        $includeCustomers = $request->query('includeCustomers');

        if ($includeCustomers) {
            $seller->loadMissing('customers');
        }

        return new SellerResource($seller);
    }

    public function update(SellerUpdateRequest $request, Seller $seller): SellerResource
    {
        $seller->update($request->validated());

        return new SellerResource($seller);
    }

    public function destroy(Request $request, Seller $seller)
    {
        $intCustQnty = Customer::where('seller_id', $seller->id)->get()->count();
        if ($intCustQnty == 0) {
            $seller->delete();
            return response()->noContent();
        } else {
            return response()->json(['errors' => 'There are ('. $intCustQnty. ') customers assigned to this seller.'], 400);
        }
    }
}
