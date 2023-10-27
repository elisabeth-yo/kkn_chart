<?php

namespace App\Services;

use App\Http\Resources\BrandResource;
use App\Models\Brand;
use App\Models\Supply;
use Illuminate\Support\Facades\DB;

class BrandService {
 
    public function store(array $brandData)
    {
        if (!Supply::where('id', $brandData['supply_id'])->exists())
            return response()->json([
                'success' => false,
                'message' => 'Supply not found',
            ], 422);
        
        DB::beginTransaction();
        
        try {
            $brandData['image'] = handleUploadedImage($brandData['image'], 'brand/');

            $brand = Brand::create($brandData);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Brand created',
                'data' => new BrandResource($brand),
            ], 201);
        } catch (\Exception $e) {
            DB::rollback();

            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 422);
        }
    }

    public function update(array $brandData, $brandId)
    {
        $brand = Brand::find($brandId);

        if (!$brand)
            return response()->json([
                'success' => false,
                'message' => 'Brand not found',
            ], 404);

        DB::beginTransaction();

        try {
            if (!empty($brandData['image'])) {
                handleDeletedImage($brand->image);
                $brandData['image'] = handleUploadedImage($brandData['image'], 'brand/');
            }

            $brand->update($brandData);
            
            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Brand updated',
                'data' => new BrandResource($brand),
            ], 200);

        } catch (\Exception $e) {
            DB::rollback();

            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 422);
        }
    }

    public function destroy($brandId)
    {
        $brand = Brand::find($brandId);

        if (!$brand)
            return response()->json([
                'success' => false,
                'message' => 'Brand not found',
            ], 404);

        DB::beginTransaction();

        try {
            //Delete all Product's image
            handleBulkDeletedImage($brand->products->pluck('image'));

            //Delete Brand's image
            handleDeletedImage($brand->image);
            
            $brand->delete();
            
            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Brand deleted',
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