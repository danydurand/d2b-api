<?php

namespace App\Http\Controllers\Api\V1;

use App\Filter\V1\PaymentConditionFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\PaymentConditionStoreRequest;
use App\Http\Requests\V1\PaymentConditionUpdateRequest;
use App\Http\Resources\V1\PaymentConditionCollection;
use App\Http\Resources\V1\PaymentConditionResource;
use App\Models\PaymentCondition;
use App\Models\Line;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PaymentConditionController extends Controller
{
    public function index(Request $request): PaymentConditionCollection
    {

        $filter = new PaymentConditionFilter();
        $filterItems = $filter->transform($request);

        // $includeLines = $request->query('includeLines');

        $paymentConditions = PaymentCondition::where($filterItems);

        // if ($includeLines) {
        //     $paymentConditions->with('lines');
        // }
        return new PaymentConditionCollection($paymentConditions->paginate()->appends($request->query()));

        // $paymentConditions = PaymentCondition::paginate();
        // return new PaymentConditionCollection($paymentConditions);
    }

    public function store(PaymentConditionStoreRequest $request): PaymentConditionResource
    {
        $paymentCondition = PaymentCondition::create($request->validated());

        return new PaymentConditionResource($paymentCondition);
    }

    public function show(Request $request, PaymentCondition $paymentCondition): PaymentConditionResource
    {
        $includeLines = $request->query('includeLines');

        if ($includeLines) {
            $paymentCondition->loadMissing('lines');
        }

        return new PaymentConditionResource($paymentCondition);
    }

    public function update(PaymentConditionUpdateRequest $request, PaymentCondition $paymentCondition): PaymentConditionResource
    {
        $paymentCondition->update($request->validated());

        return new PaymentConditionResource($paymentCondition);
    }

    public function destroy(Request $request, PaymentCondition $paymentCondition)
    {
        // $intRelaQnty = Line::where('PaymentCondition_id', $paymentCondition->id)->get()->count();
        // if ($intRelaQnty == 0) {
            $paymentCondition->delete();
            return response()->noContent();
        // } else {
        //     return response()->json(['errors' => 'There are ('. $intRelaQnty. ') Lines assigned to this PaymentCondition.'], 400);
        // }
    }
}
