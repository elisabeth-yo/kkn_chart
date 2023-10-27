<?php

namespace App\Http\Controllers;

use App\Http\Requests\BenefitRequest;
use App\Http\Requests\BenefitUpdateRequest;
use App\Http\Resources\BenefitResource;
use App\Models\Benefit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BenefitController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search ?? null;
        $type = $request->type ?? null;
        $per_page = $request->per_page ?? 10;

        $benefits = Benefit::when($request->has('search'), function ($query) use ($search) {
                                $query->where(function ($q1) use ($search) {
                                    $q1->orWhere('title', 'LIKE', "%$search%")
                                        ->orWhere('description', 'LIKE', "%$search%");
                                });
                            })
                            ->when($request->has('type'), function ($query) use ($type) {
                                $query->where('type', $type);
                            })
                            ->paginate($per_page);

        return response()->json([
            'success' => true,
            'data' => BenefitResource::collection($benefits)->response()->getData(true)
        ], 200);
    }

    public function store(BenefitRequest $request)
    {
        DB::beginTransaction();

        try {
            $input = $request->toArray();
            $input['image'] = handleUploadedImage($request->image, 'benefit/');

            $benefit = Benefit::create($input);
            
            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Benefit created',
                'data' => new BenefitResource($benefit),
            ], 201);

        } catch (\Exception $e) {
            DB::rollback();

            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 422);
        }
    }

    public function show($benefit) 
    {
        
    }

    public function update(BenefitUpdateRequest $request, $benefitId)
    {
        $benefit = Benefit::find($benefitId);

        if (!$benefit)
            return response()->json([
                'success' => false,
                'message' => 'Benefit not found',
            ], 404);

        DB::beginTransaction();

        try {
            $input = $request->toArray();
            
            if ($request->image) {
                handleDeletedImage($benefit->image);
                $input['image'] = handleUploadedImage($request->image, 'benefit/');
            }

            $benefit->update($input);
            
            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Benefit updated',
                'data' => new BenefitResource($benefit),
            ], 200);

        } catch (\Exception $e) {
            DB::rollback();

            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 422);
        }
    }

    public function destroy($benefitId)
    {
        $benefit = Benefit::find($benefitId);

        if (!$benefit)
            return response()->json([
                'success' => false,
                'message' => 'Benefit not found',
            ], 404);

        DB::beginTransaction();

        try {
            handleDeletedImage($benefit->image);

            $benefit->delete();
            
            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Benefit deleted',
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
