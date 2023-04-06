<?php

namespace App\Http\Controllers\Api\V1;

use App\Filter\V1\ConditionPaymentFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\ConditionPaymentStoreRequest;
use App\Http\Requests\V1\ConditionPaymentUpdateRequest;
use App\Http\Resources\V1\ConditionPaymentCollection;
use App\Http\Resources\V1\ConditionPaymentResource;
use App\Models\ConditionPayment;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ConditionPaymentController extends Controller
{
    public function index(Request $request): ConditionPaymentCollection
    {

        $filter = new ConditionPaymentFilter();
        $filterItems = $filter->transform($request);

        // $includeConditionPaymentTypes = $request->query('includeConditionPayments');

        $conditionPayments = ConditionPayment::where($filterItems);

        // if ($includeConditionPaymentTypes) {
        //     $conditionPayments->with('ConditionPayments');
        // }
        return new ConditionPaymentCollection($conditionPayments->paginate()->appends($request->query()));

        // $conditionPayments = ConditionPayment::paginate();
        // return new ConditionPaymentCollection($conditionPayments);
    }

    public function store(ConditionPaymentStoreRequest $request): ConditionPaymentResource
    {
        $conditionPayment = ConditionPayment::create($request->validated());

        return new ConditionPaymentResource($conditionPayment);
    }

    public function show(Request $request, ConditionPayment $conditionPayment): ConditionPaymentResource
    {
        // $includeConditionPaymentTypes = $request->query('includeConditionPayments');

        // if ($includeConditionPaymentTypes) {
        //     $conditionPayment->loadMissing('ConditionPayments');
        // }

        return new ConditionPaymentResource($conditionPayment);
    }

    public function update(ConditionPaymentUpdateRequest $request, ConditionPayment $conditionPayment): ConditionPaymentResource
    {
        $conditionPayment->update($request->validated());

        return new ConditionPaymentResource($conditionPayment);
    }

    public function destroy(Request $request, ConditionPayment $conditionPayment)
    {
        // $intCustQnty = ConditionPayment::where('ConditionPayment_id', $conditionPayment->id)->get()->count();
        // if ($intCustQnty == 0) {
            $conditionPayment->delete();
            return response()->noContent();
        // } else {
        //     return response()->json(['errors' => 'There are ('. $intCustQnty. ') ConditionPayments assigned to this ConditionPayment.'], 400);
        // }
    }
}
