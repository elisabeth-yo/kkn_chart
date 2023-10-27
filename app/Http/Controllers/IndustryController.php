<?php

namespace App\Http\Controllers;

use App\Http\Requests\IndustryRequest;
use App\Http\Requests\IndustryUpdateRequest;
use App\Http\Resources\IndustryResource;
use App\Models\Industry;
use App\Services\IndustryService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class IndustryController extends Controller
{
    public function index(Request $request)
    {
        $industries = (new IndustryService)->getIndustries($request);

        return response()->json([
            'success' => true,
            'data' => IndustryResource::collection($industries)->response()->getData(true),
        ], 200);
    }

    public function store(IndustryRequest $request)
    {
        return (new IndustryService)->store($request);
    }

    public function show($industryId) 
    {
        $industry = (new IndustryService)->getIndustryById($industryId);

        if (!$industry)
            return response()->json([
                'success' => false,
                'message' => 'Industry not found',
            ], 404);


        return response()->json([
                'success' => true,
                'data' => new IndustryResource($industry),
            ], 200);
    }

    public function update(IndustryUpdateRequest $request, $industryId)
    {
        return (new IndustryService)->update($request, $industryId);
    }
    
    public function updateSupply(Request $request, $industryId)
    {
        $request->merge(['supply_id' => json_decode($request->supply_id)]);
        
        return (new IndustryService)->updateSupply($request, $industryId);
    }
    
    public function updateBenefit(Request $request, $industryId)
    {
        $request->merge(['benefit_id' => json_decode($request->benefit_id)]);
        
        return (new IndustryService)->updateBenefit($request, $industryId);
    }

    public function destroy($industryId)
    {
        return (new IndustryService)->destroy($industryId);
    }
}
