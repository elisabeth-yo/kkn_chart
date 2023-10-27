<?php

namespace App\Services;

use App\Http\Resources\IndustryResource;
use App\Models\Benefit;
use App\Models\Industry;
use App\Models\Supply;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class IndustryService {
 
    public function getIndustries($request)
    {
        $search = $request->search ?? null;
        $per_page = $request->per_page ?? 10;
        
        return Industry::with(['supplies'])
                            ->when($request->has('search'), function ($query) use ($search) {
                                $query->where(function ($q1) use ($search) {
                                    $q1->where('title', 'LIKE', '%' . $search . '%')
                                        ->orWhere('slogan', 'LIKE', '%' . $search . '%')
                                        ->orWhere('header_slogan', 'LIKE', '%' . $search . '%')
                                        ->orWhere('header_description', 'LIKE', '%' . $search . '%') ;
                                });
                            })
                            ->paginate($per_page);
    }

    public function getIndustryById($industryId)
    {
        return Industry::with('supplies')->find($industryId);
    }

    public function getIndustryByCode($industryCode)
    {
        return Industry::with('supplies')->where('code', $industryCode)->first();
    }

    public function store($industryData)
    {
        DB::beginTransaction();
        
        try {
            $input = $industryData->except(['supply_id', 'benefit_id']);

            $input['image'] = handleUploadedImage($industryData->image, 'industry/');
            $input['header_image'] = handleUploadedImage($industryData->header_image, 'industry/');

            $industry = Industry::create($input);

            if ($industryData->supply_id) {
                $existSupply = Supply::select('id')
                                ->whereIn('id', $industryData->supply_id)
                                ->get();

                $industry->supplies()->attach($existSupply->pluck('id')->toArray());
            }

            if ($industryData->benefit_id) {
                $existBenefit = Benefit::select('id')
                                ->whereIn('id', $industryData->benefit_id)
                                ->get();

                $industry->benefits()->attach($existBenefit->pluck('id')->toArray());
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Industry created',
                'data' => new IndustryResource($industry),
            ], 201);
        } catch (\Exception $e) {
            DB::rollback();

            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 422);
        }
    }

    public function update($industryData, $industryId)
    {
        $industry = Industry::find($industryId);

        if (!$industry)
            return response()->json([
                'success' => false,
                'message' => 'Industry not found',
            ], 404);

        DB::beginTransaction();

        try {
            $input = $industryData->except(['supply_id', 'benefit_id']);

            if ($industryData->image) {
                handleDeletedImage($industry->image);
                $input['image'] = handleUploadedImage($industryData->image, 'industry/');
            }
            
            if ($industryData->header_image) {
                handleDeletedImage($industry->header_image);
                $input['header_image'] = handleUploadedImage($industryData->header_image, 'industry/');
            }

            $industry->update($input);
            
            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Industry updated',
                'data' => new IndustryResource($industry),
            ], 200);

        } catch (\Exception $e) {
            DB::rollback();

            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 422);
        }
    }

    public function updateSupply($industryData, $industryId)
    {
        $industry = Industry::find($industryId);

        if (!$industry)
            return response()->json([
                'success' => false,
                'message' => 'Industry not found',
            ], 404);

        DB::beginTransaction();

        try {
            if ($industryData->supply_id) {
                $existSupply = Supply::select('id')
                                ->whereIn('id', $industryData->supply_id)
                                ->get();

                $industry->supplies()->sync($existSupply->pluck('id')->toArray());
            } else {
                $industry->supplies()->detach();
            }
            
            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Industry updated',
                'data' => new IndustryResource($industry),
            ], 200);

        } catch (\Exception $e) {
            DB::rollback();

            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 422);
        }
    }

    public function updateBenefit($industryData, $industryId)
    {
        $industry = Industry::find($industryId);

        if (!$industry)
            return response()->json([
                'success' => false,
                'message' => 'Industry not found',
            ], 404);

        DB::beginTransaction();

        try {
            if ($industryData->benefit_id) {
                $existBenefit = Benefit::select('id')
                                ->whereIn('id', $industryData->benefit_id)
                                ->get();
                    
                $industry->benefits()->sync($existBenefit->pluck('id')->toArray());
            }  else {
                $industry->benefits()->detach();
            }
            
            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Industry updated',
                'data' => new IndustryResource($industry),
            ], 200);

        } catch (\Exception $e) {
            DB::rollback();

            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 422);
        }
    }

    public function destroy($industryId)
    {
        $industry = Industry::find($industryId);

        if (!$industry)
            return response()->json([
                'success' => false,
                'message' => 'Industry not found',
            ], 404);

        DB::beginTransaction();

        try {
            handleBulkDeletedImage([
                $industry->image,
                $industry->header_image
            ]);

            $industry->delete();
            
            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Industry deleted',
            ], 200);

        } catch (\Exception $e) {
            DB::rollback();

            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 422);
        }
    }
}