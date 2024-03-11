<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\BrandBulkStoreRequest;
use App\Http\Requests\V1\BrandBulkUpdateRequest;
use App\Http\Requests\V1\BrandStoreRequest;
use App\Http\Requests\V1\BrandSyncRequest;
use App\Http\Requests\V1\BrandUpdateRequest;
use App\Http\Resources\V1\BrandCollection;
use App\Http\Resources\V1\BrandResource;
use App\Filter\V1\BrandFilter;
use App\Models\Brand;
use App\Models\SubBrand;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Mavinoo\Batch\BatchFacade as Batch;

class BrandController extends Controller
{
    public function index(Request $request): BrandCollection
    {

        $filter = new BrandFilter();
        $filterItems = $filter->transform($request);

        $includeSubBrands = $request->query('includeSubBrands');

        $brands = Brand::where($filterItems);

        if ($includeSubBrands) {
            $brands->with('subBrands');
        }
        return new BrandCollection($brands->paginate()->appends($request->query()));

    }

    public function show(Request $request, Brand $brand): BrandResource
    {
        $includeSubBrands = $request->query('includeSubBrands');
        if ($includeSubBrands) {
            $brand->loadMissing('subBrands');
        }
        return new BrandResource($brand);
    }

    public function bulkStoreMd(Request $request)
    {
        print_r($request->all(), true);
        return response()->json(['message' => 'Hello']);
    }

    public function store(BrandStoreRequest $request): BrandResource
    {
        $brand = Brand::create($request->all());
        return new BrandResource($brand);
    }

    public function bulkStore(BrandBulkStoreRequest $request)
    {
        info('Bulk Store Brand: '.print_r($request->all(), true));
        Brand::insert($request->all());
    }

    public function batchCount(Request $request)
    {
        $batchCount = Brand::where('batch', $request->batch)->count();
        return response()->json(['message' => $batchCount]);
    }

    public function update(BrandUpdateRequest $request, Brand $brand): BrandResource
    {
        $brand->update($request->all());
        return new BrandResource($brand);
    }

    /**
    * This endpoint receives an array of json objects.  Every object contains the ID
    * records and the fields with the data that must be updated.
     */
    public function bulkUpdate(BrandBulkUpdateRequest $request)
    {

        $brandInstance = new Brand;
        // info('Bulk Update Brand: '.print_r($request->all(), true));
        $index = 'id';
        Batch::update($brandInstance, $request->all(), $index);

    }

    /**
    * This routine receives an array of json objects.  Every object contains just the
    * Id of the records that must be updated as "Synced"
     */
    public function sync(BrandSyncRequest $request)
    {
        $brandInstance = new Brand;
        $index = 'id';
        Batch::update($brandInstance, $request->all(), $index);
    }

    public function destroy(Request $request, Brand $brand)
    {
        $intRelaQnty = SubBrand::where('brand_id', $brand->id)->get()->count();
        if ($intRelaQnty == 0) {
            $brand->delete();
            return response()->noContent();
        } else {
            return response()->json(['errors' => 'There are ('. $intRelaQnty. ') SubBrands assigned to this Brand.'], 400);
        }
    }

    public function bulkDestroy(Request $request)
    {
        $batch = $request->batch;
        Brand::where('batch', $batch)->delete();
        return response()->noContent();
    }


}
