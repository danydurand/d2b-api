<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\InvoiceLineStoreRequest;
use App\Http\Requests\Api\InvoiceLineUpdateRequest;
use App\Http\Resources\Api\InvoiceLineCollection;
use App\Http\Resources\Api\InvoiceLineResource;
use App\Models\InvoiceLine;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class InvoiceLineController extends Controller
{
    public function index(Request $request): InvoiceLineCollection
    {
        $invoiceLines = InvoiceLine::all();

        return new InvoiceLineCollection($invoiceLines);
    }

    public function store(InvoiceLineStoreRequest $request): InvoiceLineResource
    {
        $invoiceLine = InvoiceLine::create($request->validated());

        return new InvoiceLineResource($invoiceLine);
    }

    public function show(Request $request, InvoiceLine $invoiceLine): InvoiceLineResource
    {
        return new InvoiceLineResource($invoiceLine);
    }

    public function update(InvoiceLineUpdateRequest $request, InvoiceLine $invoiceLine): InvoiceLineResource
    {
        $invoiceLine->update($request->validated());

        return new InvoiceLineResource($invoiceLine);
    }

    public function destroy(Request $request, InvoiceLine $invoiceLine): Response
    {
        $invoiceLine->delete();

        return response()->noContent();
    }
}
