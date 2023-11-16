<?php

namespace App\Http\Controllers;

use App\Http\Requests\JenisIbadahRequest;
use App\Http\Requests\JenisIbadahUpdateRequest;
use App\Http\Resources\JenisIbadahResource;
use App\Models\JenisIbadah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JenisIbadahController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search ?? null;
        
        $banyak_jenis_ibadah = JenisIbadah ::when($request->has('search'), function ($query) use ($search) {
                                $query->where('jenis_ibadah', 'LIKE', '%' . $search . '%');
                            })
                            ->paginate(10);

        return response()->json([
            'success' => true,
            'data' => JenisIbadahResource::collection($banyak_jenis_ibadah)->response()->getData(true),
        ], 200);
    }

    public function store(JenisIbadahRequest $request)
    {
        DB::beginTransaction();

        try {
            $input = $request->toArray();
            $jenisibadah = JenisIbadah::create($input);
            
            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Jenis Ibadah berhasil dibuat',
                'data' => new JenisIbadahResource($jenisibadah),
            ], 201);

        } catch (\Exception $e) {
            DB::rollback();

            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 422);
        }
    }

    public function update(JenisIbadahUpdateRequest $request, $id_jenis_ibadah)
    {
        $jenisibadah = JenisIbadah::find($id_jenis_ibadah);

        if (!$jenisibadah )
            return response()->json([
                'success' => false,
                'message' => 'Jenis ibadah tidak ditemukan',
            ], 404);

        DB::beginTransaction();

        try {
            $input = $request->toArray();
            
            if ($request->image) {
                handleDeletedImage($kategoripengguna ->image);
                $input['image'] = handleUploadedImage($request->image, 'Kategoripengguna/');
            }

            $jenisibadah ->update($input);
            
            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Jenis ibadah berhasil diperbaharui',
                'data' => new JenisIbadahResource($jenisibadah ),
            ], 200);

        } catch (\Exception $e) {
            DB::rollback();

            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 422);
        }
    }

    public function destroy($id_jenis_ibadah)
    {
        $jenisibadah = JenisIbadah::find($id_jenis_ibadah);

        if (!$jenisibadah )
            return response()->json([
                'success' => false,
                'message' => 'Jenis ibadah tidak ditemukan',
            ], 404);

        DB::beginTransaction();

        try {
            handleDeletedImage($jenisibadah ->image);

            $jenisibadah ->delete();
            
            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Jenis ibadah berhasil dihapus',
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
