<?php

namespace App\Http\Controllers;

use App\Http\Requests\WilayahRequest;
use App\Http\Requests\WilayahUpdateRequest;
use App\Http\Resources\WilayahResource;
use App\Models\Wilayah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WilayahController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search ?? null;
        
        $banyak_wilayah = Wilayah::when($request->has('search'), function ($query) use ($search) {
                                $query->where('nama_wilayah', 'LIKE', '%' . $search . '%');
                            })
                            ->paginate(10);

        return response()->json([
            'success' => true,
            'data' => WilayahResource::collection($banyak_wilayah)->response()->getData(true),
        ], 200);
    }

    public function store(WilayahRequest $request)
    {
        DB::beginTransaction();

        try {
            $input = $request->toArray();
            $wilayah = Wilayah::create($input);
            
            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Wilayah berhasil dibuat',
                'data' => new WilayahResource($wilayah),
            ], 201);

        } catch (\Exception $e) {
            DB::rollback();

            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 422);
        }
    }

    public function update(WilayahUpdateRequest $request, $id_wilayah)
    {
        $wilayah = Wilayah::find($id_wilayah);

        if (!$wilayah)
            return response()->json([
                'success' => false,
                'message' => 'Wilayah tidak ditemukan',
            ], 404);

        DB::beginTransaction();

        try {
            $input = $request->toArray();
            
            if ($request->image) {
                handleDeletedImage($wilayah->image);
                $input['image'] = handleUploadedImage($request->image, 'Wilayah/');
            }

            $wilayah->update($input);
            
            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Wilayah berhasil diperbaharui',
                'data' => new WilayahResource($wilayah),
            ], 200);

        } catch (\Exception $e) {
            DB::rollback();

            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 422);
        }
    }

    public function destroy($id_wilayah)
    {
        $wilayah = Wilayah::find($id_wilayah);

        if (!$wilayah)
            return response()->json([
                'success' => false,
                'message' => 'Wilayah tidak ditemukan',
            ], 404);

        DB::beginTransaction();

        try {
            handleDeletedImage($wilayah->image);

            $wilayah->delete();
            
            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Wilayah berhasil dihapus',
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
