<?php

namespace App\Services;

use App\Http\Resources\SupplyResource;
use App\Models\Benefit;
use App\Models\Supply;
use Illuminate\Support\Facades\DB;

class SupplyService {
 
    public function getSupplies($request)
    {
        $search = $request->search ?? null;
        $per_page = $request->per_page ?? 10;
        
        return Supply::with('brands')
                    ->when($request->has('search'), function ($query) use ($search) {
                        $query->where('title', 'LIKE', '%' . $search . '%');
                    })
                    ->paginate($per_page);
    }

    public function getSupplyById($supplyId)
    {
        return Supply::with('brands')->find($supplyId);
    }

    public function getSupplyByCode($supplyCode)
    {
        return Supply::with('brands')
                    ->where('code', $supplyCode)
                    ->first();
    }

    public function store($supplyData)
    {
        DB::beginTransaction();
        
        try {
            $input = $supplyData->except(['benefit_id']);
            
            $input['image'] = handleUploadedImage($supplyData->image, 'supply/');
            $input['header_image'] = handleUploadedImage($supplyData->header_image, 'supply/');

            $supply = Supply::create($input);

           if ($supplyData->benefit_id) {
                $existBenefit = Benefit::select('id')
                                ->whereIn('id', $supplyData->benefit_id)
                                ->get();

                $supply->benefits()->attach($existBenefit->pluck('id')->toArray());
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Supply created',
                'data' => new SupplyResource($supply),
            ], 201);
        } catch (\Exception $e) {
            DB::rollback();

            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 422);
        }
    }

    public function update($supplyData, $supplyId)
    {
        $supply = Supply::find($supplyId);

        if (!$supply)
            return response()->json([
                'success' => false,
                'message' => 'Supply not found',
            ], 404);

        DB::beginTransaction();

        try {
            $input = $supplyData->except(['benefit_id']);

            if ($supplyData->image) {
                handleDeletedImage($supply->image);
                $input['image'] = handleUploadedImage($supplyData->image, 'supply/');
            }
            
            if ($supplyData->header_image) {
                handleDeletedImage($supply->header_image);
                $input['header_image'] = handleUploadedImage($supplyData->header_image, 'supply/');
            }

            $supply->update($input);
            
            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Supply updated',
                'data' => new SupplyResource($supply),
            ], 200);

        } catch (\Exception $e) {
            DB::rollback();

            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 422);
        }
    }

    public function updateBenefit($supplyData, $supplyId)
    {
        $supply = Supply::find($supplyId);

        if (!$supply)
            return response()->json([
                'success' => false,
                'message' => 'Supply not found',
            ], 404);

        DB::beginTransaction();

        try {
            if ($supplyData->benefit_id) {
                $existBenefit = Benefit::select('id')
                                ->whereIn('id', $supplyData->benefit_id)
                                ->get();
                    
                $supply->benefits()->sync($existBenefit->pluck('id')->toArray());
            }  else {
                $supply->benefits()->detach();
            }
            
            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Supply updated',
                'data' => new SupplyResource($supply),
            ], 200);

        } catch (\Exception $e) {
            DB::rollback();

            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 422);
        }
    }

    public function destroy($supplyId)
    {
        $supply = Supply::with('brands.products')->find($supplyId);

        if (!$supply)
            return response()->json([
                'success' => false,
                'message' => 'Supply not found',
            ], 404);

        DB::beginTransaction();

        try {
            //Delete all Product's image
            foreach ($supply->brands as $brand) {
                handleBulkDeletedImage($brand->products->pluck('image'));
            }

            //Delete all Brand's image
            handleBulkDeletedImage($supply->brands->pluck('image'));

            //Delete Supply's image
            handleBulkDeletedImage([
                $supply->image,
                $supply->header_image
            ]);

            $supply->delete();
            
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