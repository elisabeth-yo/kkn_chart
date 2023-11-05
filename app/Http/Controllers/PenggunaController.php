<?php

namespace App\Http\Controllers;

use App\Http\Requests\PenggunaRequest;
use App\Http\Requests\PenggunaUpdateRequest;
use App\Http\Resources\PenggunaResource;
use App\Models\Pengguna;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PenggunaController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search ?? null;
        
        $banyak_pengguna = Pengguna::when($request->has('search'), function ($query) use ($search) {
                                $query->where('id_pengguna', 'LIKE', '%' . $search . '%');
                            })
                            ->paginate(10);

        return response()->json([
            'success' => true,
            'data' => PenggunaResource::collection($banyak_pengguna)->response()->getData(true),
        ], 200);
    }

    public function store(PenggunaRequest $request)
    {
        DB::beginTransaction();

        try {
            $input = $request->toArray();
            $pengguna = Pengguna::create($input);
            
            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Pengguna berhasil dibuat',
                'data' => new PenggunaResource($pengguna),
            ], 201);

        } catch (\Exception $e) {
            DB::rollback();

            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 422);
        }
    }

    public function update(PenggunaUpdateRequest $request, $id_pengguna)
    {
        $pengguna = Pengguna::find($id_pengguna);

        if (!$pengguna)
            return response()->json([
                'success' => false,
                'message' => 'Pengguna tidak ditemukan',
            ], 404);

        DB::beginTransaction();

        try {
            $input = $request->toArray();
            
            if ($request->image) {
                handleDeletedImage($pengguna->image);
                $input['image'] = handleUploadedImage($request->image, 'Pengguna/');
            }

            $pengguna->update($input);
            
            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Pengguna berhasil diperbaharui',
                'data' => new PenggunaResource($pengguna),
            ], 200);

        } catch (\Exception $e) {
            DB::rollback();

            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 422);
        }
    }

    public function destroy($id_pengguna)
    {
        $pengguna = Pengguna::find($id_pengguna);

        if (!$pengguna)
            return response()->json([
                'success' => false,
                'message' => 'Pengguna tidak ditemukan',
            ], 404);

        DB::beginTransaction();

        try {
            handleDeletedImage($pengguna->image);

            $pengguna->delete();
            
            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Pengguna berhasil dihapus',
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
