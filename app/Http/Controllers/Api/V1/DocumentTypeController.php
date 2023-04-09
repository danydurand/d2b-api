<?php

namespace App\Http\Controllers\Api\V1;

use App\Filter\V1\DocumentTypeFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\DocumentTypeStoreRequest;
use App\Http\Requests\V1\DocumentTypeUpdateRequest;
use App\Http\Resources\V1\DocumentTypeCollection;
use App\Http\Resources\V1\DocumentTypeResource;
use App\Models\DocumentType;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class DocumentTypeController extends Controller
{
    public function index(Request $request): DocumentTypeCollection
    {

        $filter = new DocumentTypeFilter();
        $filterItems = $filter->transform($request);

        $documentTypes = DocumentType::where($filterItems);

        return new DocumentTypeCollection($documentTypes->paginate()->appends($request->query()));

        // $documentTypes = Line::paginate();
        // return new LineCollection($documentTypes);
    }

    public function store(DocumentTypeStoreRequest $request): DocumentTypeResource
    {
        $documentType = DocumentType::create($request->validated());

        return new DocumentTypeResource($documentType);
    }

    public function show(Request $request, DocumentType $documentType): DocumentTypeResource
    {
        return new DocumentTypeResource($documentType);
    }

    public function update(DocumentTypeUpdateRequest $request, DocumentType $documentType): DocumentTypeResource
    {
        $documentType->update($request->validated());

        return new DocumentTypeResource($documentType);
    }

    public function destroy(Request $request, DocumentType $documentType)
    {
        $documentType->delete();
        return response()->noContent();
    }
}
