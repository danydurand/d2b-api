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
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

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
        $loop = 0;
        $errorCount = 0;
        // Creating items collection
        $data = collect($request->input('sellers'));
        // Processing the collection in chunks
        $data->chunk(10)->each(function ($chunk) use (&$loop, &$errorCount) {

            $items = [];
            foreach ($chunk as $key => $value) {
                $items[] = [
                    'name'               => $value['name'],
                    'sales_commission'   => $value['salesCommission'],
                    'collect_commission' => $value['collectCommission'],
                    'login'              => $value['login'],
                    'password'           => \Hash::make('password'),
                    'sync_at'            => Carbon::now(),
                    'created_by'         => 1,
                    'updated_by'         => 1,
                ];
                $loop++;
            }
            // Bulk insert
            try {
                Seller::insert($items);
            } catch (\Exception $e) {
                $errorCount++;
            } catch (\Error $e) {
                $errorCount++;
            }
        });

        $userMessage = $loop.' record processed. Errors count: '.$errorCount;
        return response()->json(['message' => $userMessage]);
    }

    public function store(SellerStoreRequest $request): SellerResource
    {
        $seller = Seller::create($request->validated());
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
