<?php

namespace App\Http\Controllers\Api\V1;

use App\Filter\V1\InvoiceLineFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\InvoiceLineStoreRequest;
use App\Http\Requests\V1\InvoiceLineUpdateRequest;
use App\Http\Resources\V1\InvoiceLineCollection;
use App\Http\Resources\V1\InvoiceLineResource;
use App\Models\InvoiceLine;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class InvoiceLineController extends Controller
{
    public function index(Request $request): InvoiceLineCollection
    {

        $filter = new InvoiceLineFilter();
        $filterItems = $filter->transform($request);

        // $includeLines = $request->query('includeLines');

        $invoiceLines = InvoiceLine::where($filterItems);

        // if ($includeLines) {
        //     $invoiceLines->with('invoiceLines');
        // }
        return new InvoiceLineCollection($invoiceLines->paginate()->appends($request->query()));

        // $invoiceLines = Invoice::paginate();
        // return new InvoiceCollection($invoiceLines);
    }

    public function store(InvoiceLineStoreRequest $request): InvoiceLineResource
    {
        $invoiceLine = InvoiceLine::create($request->validated());

        return new InvoiceLineResource($invoiceLine);
    }

    public function show(Request $request, InvoiceLine $invoiceLine): InvoiceLineResource
    {
        // $includeLines = $request->query('includeLines');

        // if ($includeLines) {
        //     $invoiceLine->loadMissing('invoiceLines');
        // }

        return new InvoiceLineResource($invoiceLine);
    }

    public function update(InvoiceLineUpdateRequest $request, InvoiceLine $invoiceLine): InvoiceLineResource
    {
        $invoiceLine->update($request->validated());

        return new InvoiceLineResource($invoiceLine);
    }

    public function destroy(Request $request, InvoiceLine $invoiceLine)
    {
        // $intLineQnty = InvoiceLine::where('invoice_id', $invoiceLine->id)->get()->count();
        // if ($intLineQnty == 0) {
            $invoiceLine->delete();
            return response()->noContent();
        // } else {
        //     return response()->json(['errors' => 'There are ('. $intLineQnty. ') invoice lines assigned to this Invoice.'], 400);
        // }
    }
}
