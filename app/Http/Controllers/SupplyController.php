<?php

namespace App\Http\Controllers;

use App\Http\Requests\SupplyRequest;
use App\Http\Requests\SupplyUpdateRequest;
use App\Http\Resources\SupplyResource;
use App\Models\Supply;
use App\Services\SupplyService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SupplyController extends Controller
{
    public function index(Request $request)
    {
        $supplies = (new SupplyService)->getSupplies($request);

        return response()->json([
                'success' => true,
                'data' => SupplyResource::collection($supplies)->response()->getData(true),
            ], 200);
    }

    public function store(SupplyRequest $request)
    {
        return (new SupplyService)->store($request);
    }

    public function show($supplyId) 
    {
        $supply = (new SupplyService)->getSupplyById($supplyId);

        if (!$supply)
            return response()->json([
                'success' => false,
                'message' => 'Supply not found',
            ], 404);


        return response()->json([
                'success' => true,
                'data' => new SupplyResource($supply),
            ], 200);
    }

    public function update(SupplyUpdateRequest $request, $supplyId)
    {
        return (new SupplyService)->update($request, $supplyId);
    }

    public function updateBenefit(Request $request, $supplyId)
    {
        $request->merge(['benefit_id' => json_decode($request->benefit_id)]);
        
        return (new SupplyService)->updateBenefit($request, $supplyId);
    }

    public function destroy($supplyId)
    {
        return (new SupplyService)->destroy($supplyId);
    }
}
