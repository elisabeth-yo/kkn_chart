<?php

namespace App\Http\Controllers;

use App\Http\Requests\PublikasiRenunganRequest;
use App\Http\Requests\PublikasiRenunganUpdateRequest;
use App\Http\Resources\PublikasiRenunganResource;
use App\Models\PublikasiRenungan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PublikasiRenunganController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search ?? null;
        
        $banyak_publikasi_renungan = PublikasiRenungan::when($request->has('search'), function ($query) use ($search) {
                                $query->where('tanggal_publikasi', 'LIKE', '%' . $search . '%');
                            })
                            ->paginate(10);

        return response()->json([
            'success' => true,
            'data' => PublikasiRenunganResource::collection($banyak_publikasi_renungan)->response()->getData(true),
        ], 200);
    }

    public function store(PublikasiRenunganRequest $request)
    {
        DB::beginTransaction();

        try {
            $input = $request->toArray();
            
           

            $publikasirenungan = PublikasiRenungan::create($input);
            
            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Publikasi Renungan berhasil dibuat',
                'data' => new PublikasiRenunganResource($publikasirenungan),
            ], 201);

        } catch (\Exception $e) {
            DB::rollback();

            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 422);
        }
    }

    public function update(PublikasiRenunganUpdateRequest $request, $id_publikasi_renungan)
    {
        $publikasirenungan = PublikasiRenungan::find($id_publikasi_renungan);

        if (!$publikasirenungan )
            return response()->json([
                'success' => false,
                'message' => 'Publikasi Renungan tidak ditemukan',
            ], 404);

        DB::beginTransaction();

        try {
            $input = $request->toArray();
        

            $publikasirenungan ->update($input);
            
            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Publikasi Renungan berhasil diperbaharui',
                'data' => new PublikasiRenunganResource($publikasirenungan ),
            ], 200);

        } catch (\Exception $e) {
            DB::rollback();

            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 422);
        }
    }

    public function destroy($id_publikasi_renungan)
    {
        $publikasirenungan = PublikasiRenungan::find($id_publikasi_renungan);

        if (!$publikasirenungan )
            return response()->json([
                'success' => false,
                'message' => 'Publikasi Renungan tidak ditemukan',
            ], 404);

        DB::beginTransaction();

        try {
           

            $publikasirenungan ->delete();
            
            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Publikasi Renungan berhasil dihapus',
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