<?php

namespace App\Http\Controllers;

use App\Http\Requests\JadwalIbadahRequest;
use App\Http\Requests\JadwalIbadahUpdateRequest;
use App\Http\Resources\JadwalIbadahResource;
use App\Models\JadwalIbadah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JadwalIbadahController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search ?? null;
        
        $banyak_jadwal_ibadah = JadwalIbadah::when($request->has('search'), function ($query) use ($search) {
                                $query->where('nama_ibadah', 'LIKE', '%' . $search . '%');
                            })
                            ->paginate(10);

        return response()->json([
            'success' => true,
            'data' => JadwalIbadahResource::collection($banyak_jadwal_ibadah)->response()->getData(true),
        ], 200);
    }

    public function store(JadwalIbadahRequest $request)
    {
        DB::beginTransaction();

        try {
            $input = $request->toArray();
            $input['file_poster'] = handleUploadedImage($request->file_poster, 'jadwalibadah/');
            
            $jadwalibadah = JadwalIbadah::create($input);
            
            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Jadwal Ibadah berhasil dibuat',
                'data' => new JadwalIbadahResource($jadwalibadah),
            ], 201);

        } catch (\Exception $e) {
            DB::rollback();

            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 422);
        }
    }

    public function update(JadwalIbadahUpdateRequest $request, $id_jadwal_ibadah)
    {
        $jadwalibadah = JadwalIbadah::find($id_jadwal_ibadah);

        if (!$jadwalibadah )
            return response()->json([
                'success' => false,
                'message' => 'Jadwal Ibadah tidak ditemukan',
            ], 404);

        DB::beginTransaction();

        try {
            $input = $request->toArray();
            
            if ($request->file_poster) {
                handleDeletedImage($jadwalibadah ->file_poster);
                $input['file_poster'] = handleUploadedImage($request->file_poster, 'jadwalibadah/');
                

            }
            
           

            $jadwalibadah ->update($input);
            
            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Jadwal Ibadah berhasil diperbaharui',
                'data' => new JadwalIbadahResource($jadwalibadah ),
            ], 200);

        } catch (\Exception $e) {
            DB::rollback();

            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 422);
        }
    }

    public function destroy($id_jadwal_ibadah)
    {
        $jadwalibadah = JadwalIbadah::find($id_jadwal_ibadah);

        if (!$jadwalibadah )
            return response()->json([
                'success' => false,
                'message' => 'Jadwal Ibadah tidak ditemukan',
            ], 404);

        DB::beginTransaction();

        try {
            handleDeletedImage($jadwalibadah ->file_poster);
            

            $jadwalibadah ->delete();
            
            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Jadwal Ibadah berhasil dihapus',
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