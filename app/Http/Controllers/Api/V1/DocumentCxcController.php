<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\DocumentCxcStoreRequest;
use App\Http\Requests\V1\DocumentCxcUpdateRequest;
use App\Http\Resources\V1\DocumentCxcCollection;
use App\Http\Resources\V1\DocumentCxcResource;
use App\Filter\V1\DocumentCxcFilter;
use App\Models\DocumentCxc;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class DocumentCxcController extends Controller
{
    public function index(Request $request): DocumentCxcCollection
    {

        $filter = new DocumentCxcFilter();
        $filterItems = $filter->transform($request);

        // $includeSubDocumentCxcs = $request->query('includeSubDocumentCxcs');

        $documentCxcs = DocumentCxc::where($filterItems);

        // if ($includeSubDocumentCxcs) {
        //     $documentCxcs->with('subDocumentCxcs');
        // }
        return new DocumentCxcCollection($documentCxcs->paginate()->appends($request->query()));

        // $documentCxcs = DocumentCxc::paginate();
        // return new DocumentCxcCollection($documentCxcs);
    }

    public function store(DocumentCxcStoreRequest $request): DocumentCxcResource
    {
        $documentCxc = DocumentCxc::create($request->validated());

        return new DocumentCxcResource($documentCxc);
    }

    public function show(Request $request, DocumentCxc $documentCxc): DocumentCxcResource
    {
        // $includeSubDocumentCxcs = $request->query('includeSubDocumentCxcs');

        // if ($includeSubDocumentCxcs) {
        //     $documentCxc->loadMissing('subDocumentCxcs');
        // }

        return new DocumentCxcResource($documentCxc);
    }

    public function update(DocumentCxcUpdateRequest $request, DocumentCxc $documentCxc): DocumentCxcResource
    {
        $documentCxc->update($request->validated());

        return new DocumentCxcResource($documentCxc);
    }

    public function destroy(Request $request, DocumentCxc $documentCxc)
    {
        // $intRelaQnty = SubDocumentCxc::where('DocumentCxc_id', $documentCxc->id)->get()->count();
        // if ($intRelaQnty == 0) {
            $documentCxc->delete();
            return response()->noContent();
        // } else {
        //     return response()->json(['errors' => 'There are ('. $intRelaQnty. ') SubDocumentCxcs assigned to this DocumentCxc.'], 400);
        // }
    }
}
