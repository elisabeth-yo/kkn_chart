<?php

namespace App\Http\Controllers;

use App\Http\Requests\BrandRequest;
use App\Http\Requests\BrandUpdateRequest;
use App\Http\Resources\BrandResource;
use App\Models\Brand;
use Illuminate\Support\Facades\DB;
use App\Services\BrandService;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index(Request $request, $supplyId)
    {
        $search = $request->search ?? null;
        
        $brands = Brand::with('products')
                            ->where('supply_id', $supplyId)
                            ->when($request->has('search'), function ($query) use ($search) {
                                $query->where('title', 'LIKE', '%' . $search . '%');
                            })
                            ->paginate(10);
                            
        return response()->json([
            'success' => true,
            'data' => BrandResource::collection($brands)->response()->getData(true),
        ], 200);
    }

    public function store(BrandRequest $request)
    {
        return (new BrandService())->store($request->toArray());
    }

    public function show($brandId) 
    {
        $brand = Brand::with('products')->find($brandId);

        if (!$brand)
            return response()->json([
                'success' => false,
                'message' => 'Brand not found',
            ], 404);


        return response()->json([
                'success' => true,
                'data' => new BrandResource($brand),
            ], 200);
    }

    public function update(BrandUpdateRequest $request, $brandId)
    {
        return (new BrandService())->update($request->toArray(), $brandId);
    }

    public function destroy($brandId)
    {
        return (new BrandService())->destroy($brandId);
    }
}
