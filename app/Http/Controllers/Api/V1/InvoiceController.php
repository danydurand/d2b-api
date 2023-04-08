<?php

namespace App\Http\Controllers\Api\V1;

use App\Filter\V1\InvoiceFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\InvoiceStoreRequest;
use App\Http\Requests\V1\InvoiceUpdateRequest;
use App\Http\Resources\V1\InvoiceCollection;
use App\Http\Resources\V1\InvoiceResource;
use App\Models\Customer;
use App\Models\Invoice;
use App\Models\InvoiceLine;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class InvoiceController extends Controller
{
    public function index(Request $request): InvoiceCollection
    {

        $filter = new InvoiceFilter();
        $filterItems = $filter->transform($request);

        $includeLines = $request->query('includeLines');

        $invoices = Invoice::where($filterItems);

        if ($includeLines) {
            $invoices->with('invoiceLines');
        }
        return new InvoiceCollection($invoices->paginate()->appends($request->query()));

        // $invoices = Invoice::paginate();
        // return new InvoiceCollection($invoices);
    }

    public function store(InvoiceStoreRequest $request): InvoiceResource
    {
        $invoice = Invoice::create($request->validated());

        return new InvoiceResource($invoice);
    }

    public function show(Request $request, Invoice $invoice): InvoiceResource
    {
        $includeLines = $request->query('includeLines');

        if ($includeLines) {
            $invoice->loadMissing('invoiceLines');
        }

        return new InvoiceResource($invoice);
    }

    public function update(InvoiceUpdateRequest $request, Invoice $invoice): InvoiceResource
    {
        $invoice->update($request->validated());

        return new InvoiceResource($invoice);
    }

    public function destroy(Request $request, Invoice $invoice)
    {
        $intLineQnty = InvoiceLine::where('invoice_id', $invoice->id)->get()->count();
        if ($intLineQnty == 0) {
            $invoice->delete();
            return response()->noContent();
        } else {
            return response()->json(['errors' => 'There are ('. $intLineQnty. ') invoice lines assigned to this Invoice.'], 400);
        }
    }
}
