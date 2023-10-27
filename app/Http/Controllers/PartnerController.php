<?php

namespace App\Http\Controllers;

use App\Http\Requests\PartnerRequest;
use App\Http\Requests\PartnerUpdateRequest;
use App\Http\Resources\PartnerResource;
use App\Models\Partner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PartnerController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search ?? null;
        
        $partners = Partner::when($request->has('search'), function ($query) use ($search) {
                                $query->where('title', 'LIKE', '%' . $search . '%');
                            })
                            ->paginate(10);

        return response()->json([
            'success' => true,
            'data' => PartnerResource::collection($partners)->response()->getData(true),
        ], 200);
    }

    public function store(PartnerRequest $request)
    {
        DB::beginTransaction();

        try {
            $input = $request->toArray();
            $input['image'] = handleUploadedImage($request->image, 'partner/');

            $partner = Partner::create($input);
            
            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Partner created',
                'data' => new PartnerResource($partner),
            ], 201);

        } catch (\Exception $e) {
            DB::rollback();

            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 422);
        }
    }

    public function update(PartnerUpdateRequest $request, $partnerId)
    {
        $partner = Partner::find($partnerId);

        if (!$partner)
            return response()->json([
                'success' => false,
                'message' => 'Partner not found',
            ], 404);

        DB::beginTransaction();

        try {
            $input = $request->toArray();
            
            if ($request->image) {
                handleDeletedImage($partner->image);
                $input['image'] = handleUploadedImage($request->image, 'partner/');
            }

            $partner->update($input);
            
            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Partner updated',
                'data' => new PartnerResource($partner),
            ], 200);

        } catch (\Exception $e) {
            DB::rollback();

            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 422);
        }
    }

    public function destroy($partnerId)
    {
        $partner = Partner::find($partnerId);

        if (!$partner)
            return response()->json([
                'success' => false,
                'message' => 'Partner not found',
            ], 404);

        DB::beginTransaction();

        try {
            handleDeletedImage($partner->image);

            $partner->delete();
            
            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Partner deleted',
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
