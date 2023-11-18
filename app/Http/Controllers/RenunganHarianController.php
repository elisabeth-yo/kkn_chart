<?php

namespace App\Http\Controllers;

use App\Http\Requests\RenunganHarianRequest;
use App\Http\Requests\RenunganHarianUpdateRequest;
use App\Http\Resources\RenunganHarianResource;
use App\Models\RenunganHarian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RenunganHarianController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search ?? null;
        
        $banyak_renungan_harian = RenunganHarian::when($request->has('search'), function ($query) use ($search) {
                                $query->where('tanggal_dibuat', 'LIKE', '%' . $search . '%');
                            })
                            ->paginate(10);

        return response()->json([
            'success' => true,
            'data' => RenunganHarianResource::collection($banyak_renungan_harian)->response()->getData(true),
        ], 200);
    }

    public function store(RenunganHarianRequest $request)
    {
        DB::beginTransaction();

        try {
            $input = $request->toArray();
            $input['gambar_bahan_bacaan'] = handleUploadedImage($request->gambar_bahan_bacaan, 'renunganharian/');
           
            $renunganharian = RenunganHarian::create($input);
            
            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Renungan Harian berhasil dibuat',
                'data' => new RenunganHarianResource($renunganharian),
            ], 201);

        } catch (\Exception $e) {
            DB::rollback();

            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 422);
        }
    }

    public function update(RenunganHarianUpdateRequest $request, $id_renungan)
    {
        $renunganharian = RenunganHarian::find($id_renungan);

        if (!$renunganharian )
            return response()->json([
                'success' => false,
                'message' => 'Renungan harian tidak ditemukan',
            ], 404);

        DB::beginTransaction();

        try {
            $input = $request->toArray();
            
            if ($request->gambar_bahan_bacaan) {
                handleDeletedImage($renunganharian ->gambar_bahan_bacaan);
                $input['gambar_bahan_bacaan'] = handleUploadedImage($request->gambar_bahan_bacaan, 'renunganharian/');
                

            }

            $renunganharian ->update($input);
            
            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Renungan Harian berhasil diperbaharui',
                'data' => new RenunganHarianResource($renunganharian ),
            ], 200);

        } catch (\Exception $e) {
            DB::rollback();

            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 422);
        }
    }

    public function destroy($id_renungan)
    {
        $renunganharian = RenunganHarian::find($id_renungan);

        if (!$renunganharian )
            return response()->json([
                'success' => false,
                'message' => 'Renungan harian tidak ditemukan',
            ], 404);

        DB::beginTransaction();

        try {
            handleDeletedImage($renunganharian ->gambar_bahan_bacaan);

            $renunganharian ->delete();
            
            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Renungan Harian berhasil dihapus',
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