<?php

namespace App\Http\Controllers;

use App\Http\Requests\PresensiJemaatRequest;
use App\Http\Requests\PresensiJemaatUpdateRequest;
use App\Http\Resources\PresensiJemaatResource;
use App\Models\PresensiJemaat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PresensiJemaatController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search ?? null;
        
        $banyak_presensi_jemaat = PresensiJemaat::when($request->has('search'), function ($query) use ($search) {
                                $query->where('tanggal_waktu_presensi', 'LIKE', '%' . $search . '%');
                            })
                            ->paginate(10);

        return response()->json([
            'success' => true,
            'data' => PresensiJemaatResource::collection($banyak_presensi_jemaat)->response()->getData(true),
        ], 200);
    }

    public function store(PresensiJemaatRequest $request)
    {
        DB::beginTransaction();

        try {
            $input = $request->toArray();
            
           

            $presensijemaat = PresensiJemaat::create($input);
            
            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Presensi Jemaat berhasil dibuat',
                'data' => new PresensiJemaatResource($presensijemaat),
            ], 201);

        } catch (\Exception $e) {
            DB::rollback();

            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 422);
        }
    }

    public function update(PresensiJemaatUpdateRequest $request, $id_presensi_jemaat)
    {
        $presensijemaat = PresensiJemaat::find($id_presensi_jemaat);

        if (!$presensijemaat )
            return response()->json([
                'success' => false,
                'message' => 'Presensi Jemaat tidak ditemukan',
            ], 404);

        DB::beginTransaction();

        try {
            $input = $request->toArray();
        

            $presensijemaat ->update($input);
            
            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Presensi Jemaat berhasil diperbaharui',
                'data' => new PresensiJemaatResource($presensijemaat ),
            ], 200);

        } catch (\Exception $e) {
            DB::rollback();

            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 422);
        }
    }

    public function destroy($id_presensi_jemaat)
    {
        $presensijemaat = PresensiJemaat::find($id_presensi_jemaat);

        if (!$presensijemaat )
            return response()->json([
                'success' => false,
                'message' => 'Presensi Jemaat tidak ditemukan',
            ], 404);

        DB::beginTransaction();

        try {
           

            $presensijemaat ->delete();
            
            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Presensi Jemaat berhasil dihapus',
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