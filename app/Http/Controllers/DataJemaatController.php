<?php

namespace App\Http\Controllers;

use App\Http\Requests\DataJemaatRequest;
use App\Http\Requests\DataJemaatUpdateRequest;
use App\Http\Resources\DataJemaatResource;
use App\Models\DataJemaat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class DataJemaatController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search ?? null;
        
        $banyak_data_jemaat = DataJemaat::when($request->has('search'), function ($query) use ($search) {
                                $query->where('nama_lengkap', 'LIKE', '%' . $search . '%');
                            })
                            ->paginate(10);

        return response()->json([
            'success' => true,
            'data' => DataJemaatResource::collection($banyak_data_jemaat)->response()->getData(true),
        ], 200);
    }

    public function store(DataJemaatRequest $request)
    {
        DB::beginTransaction();

        try {
            $input = $request->toArray();
            $input['foto'] = handleUploadedImage($request->poster_kegiatan, 'datajemaat/');
            $datajemaat = DataJemaat::create($input);
            
            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Data jemaat berhasil dibuat',
                'data' => new DataJemaatResource($datajemaat),
            ], 201);

        } catch (\Exception $e) {
            DB::rollback();

            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 422);
        }
    }

    public function update(DataJemaatUpdateRequest $request, $id_data_jemaat)
    {
        $datajemaat = DataJemaat::find($id_data_jemaat);

        if (!$datajemaat )
            return response()->json([
                'success' => false,
                'message' => 'Data jawab tidak ditemukan',
            ], 404);

        DB::beginTransaction();

        try {
            $input = $request->toArray();
            
            if ($request->foto) {
                handleDeletedImage($datajemaat ->foto);
                $input['foto'] = handleUploadedImage($request->foto, 'datajemaat/');
                

            }

            $datajemaat ->update($input);
            
            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Data jemaat berhasil diperbaharui',
                'data' => new DataJemaatResource($datajemaat ),
            ], 200);

        } catch (\Exception $e) {
            DB::rollback();

            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 422);
        }
    }

    public function destroy($id_data_jemaat)
    {
        $datajemaat = DataJemaat::find($id_data_jemaat);

        if (!$datajemaat )
            return response()->json([
                'success' => false,
                'message' => 'Data jemaat tidak ditemukan',
            ], 404);

        DB::beginTransaction();

        try {
            handleDeletedImage($datajemaat ->foto);
            
            $datajemaat ->delete();
            
            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Data jemaat berhasil dihapus',
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
