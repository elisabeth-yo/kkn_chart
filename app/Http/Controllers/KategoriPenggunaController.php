<?php

namespace App\Http\Controllers;

use App\Http\Requests\KategoriPenggunaRequest;
use App\Http\Requests\KategoriPenggunaUpdateRequest;
use App\Http\Resources\KategoriPenggunaResource;
use App\Models\KategoriPengguna;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KategoriPenggunaController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search ?? null;
        
        $banyak_kategori_pengguna = KategoriPengguna::when($request->has('search'), function ($query) use ($search) {
                                $query->where('jenis_pengguna', 'LIKE', '%' . $search . '%');
                            })
                            ->paginate(10);

        return response()->json([
            'success' => true,
            'data' => KategoriPenggunaResource::collection($banyak_kategori_pengguna)->response()->getData(true),
        ], 200);
    }

    public function store(KategoriPenggunaRequest $request)
    {
        DB::beginTransaction();

        try {
            $input = $request->toArray();
            $kategoripengguna = KategoriPengguna::create($input);
            
            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Kategori Pengguna berhasil dibuat',
                'data' => new KategoriPenggunaResource($kategoripengguna),
            ], 201);

        } catch (\Exception $e) {
            DB::rollback();

            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 422);
        }
    }

    public function update(KategoriPenggunaUpdateRequest $request, $id_kategori_pengguna)
    {
        $kategoripengguna = KategoriPengguna::find($id_kategori_pengguna);

        if (!$kategoripengguna )
            return response()->json([
                'success' => false,
                'message' => 'Kategori Pengguna tidak ditemukan',
            ], 404);

        DB::beginTransaction();

        try {
            $input = $request->toArray();
            
            if ($request->image) {
                handleDeletedImage($kategoripengguna ->image);
                $input['image'] = handleUploadedImage($request->image, 'Kategoripengguna/');
            }

            $kategoripengguna ->update($input);
            
            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Kategori Pengguna berhasil diperbaharui',
                'data' => new KategoriPenggunaResource($kategoripengguna ),
            ], 200);

        } catch (\Exception $e) {
            DB::rollback();

            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 422);
        }
    }

    public function destroy($id_kategori_pengguna)
    {
        $kategoripengguna = KategoriPengguna::find($id_kategori_pengguna);

        if (!$kategoripengguna )
            return response()->json([
                'success' => false,
                'message' => 'Kategori Pengguna tidak ditemukan',
            ], 404);

        DB::beginTransaction();

        try {
            handleDeletedImage($kategoripengguna ->image);

            $kategoripengguna ->delete();
            
            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Kategori Pengguna berhasil dihapus',
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