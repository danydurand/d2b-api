<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\BranchStoreRequest;
use App\Http\Requests\V1\BranchUpdateRequest;
use App\Http\Resources\V1\BranchCollection;
use App\Http\Resources\V1\BranchResource;
use App\Filter\V1\BranchFilter;
use App\Models\Branch;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BranchController extends Controller
{
    public function index(Request $request): BranchCollection
    {

        $filter = new BranchFilter();
        $filterItems = $filter->transform($request);

        // $includeSubBranchs = $request->query('includeSubBranchs');

        $branchs = Branch::where($filterItems);

        // if ($includeSubBranchs) {
        //     $branchs->with('subBranchs');
        // }
        return new BranchCollection($branchs->paginate()->appends($request->query()));

        // $branchs = Branch::paginate();
        // return new BranchCollection($branchs);
    }

    public function store(BranchStoreRequest $request): BranchResource
    {
        $branch = Branch::create($request->validated());

        return new BranchResource($branch);
    }

    public function show(Request $request, Branch $branch): BranchResource
    {
        // $includeSubBranchs = $request->query('includeSubBranchs');

        // if ($includeSubBranchs) {
        //     $branch->loadMissing('subBranchs');
        // }

        return new BranchResource($branch);
    }

    public function update(BranchUpdateRequest $request, Branch $branch): BranchResource
    {
        $branch->update($request->validated());

        return new BranchResource($branch);
    }

    public function destroy(Request $request, Branch $branch)
    {
        // $intRelaQnty = SubBranch::where('Branch_id', $branch->id)->get()->count();
        // if ($intRelaQnty == 0) {
            $branch->delete();
            return response()->noContent();
        // } else {
        //     return response()->json(['errors' => 'There are ('. $intRelaQnty. ') SubBranchs assigned to this Branch.'], 400);
        // }
    }
}
