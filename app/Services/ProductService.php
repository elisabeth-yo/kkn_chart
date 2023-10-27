<?php

namespace App\Services;

use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Models\Brand;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\DB;

class ProductService {
 
    public function store(array $productData)
    {
        if (!Brand::where('id', $productData['brand_id'])->exists())
            return response()->json([
                'success' => false,
                'message' => 'Brand not found',
            ], 422);
        
        DB::beginTransaction();
        
        try {
            $productData['image'] = handleUploadedImage($productData['image'], 'product/');
            
            $product = Product::create($productData);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Product created',
                'data' => new ProductResource($product),
            ], 201);
        } catch (\Exception $e) {
            DB::rollback();

            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 422);
        }
    }

    public function update(array $productData, $productId)
    {
        $product = Product::find($productId);

        if (!$product)
            return response()->json([
                'success' => false,
                'message' => 'Product not found',
            ], 404);

        DB::beginTransaction();

        try {
            if (!empty($productData['image'])) {
                handleDeletedImage($product->image);
                $productData['image'] = handleUploadedImage($productData['image'], 'product/');
            }

            $product->update($productData);
            
            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Product updated',
                'data' => new ProductResource($product),
            ], 200);

        } catch (\Exception $e) {
            DB::rollback();

            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 422);
        }
    }

    public function destroy($productId)
    {
        $product = Product::find($productId);

        if (!$product)
            return response()->json([
                'success' => false,
                'message' => 'Product not found',
            ], 404);

        DB::beginTransaction();

        try {
            handleDeletedImage($product->image);
            
            $product->delete();
            
            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Product deleted',
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