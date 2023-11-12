<?php

namespace App\Http\Controllers;

use App\Http\Requests\WartaJemaatRequest;
use App\Http\Requests\WartaJemaatUpdateRequest;
use App\Http\Resources\WartaJemaatResource;
use App\Models\WartaJemaat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class WartaJemaatController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search ?? null;
        
        $banyak_warta_jemaat = WartaJemaat::when($request->has('search'), function ($query) use ($search) {
                                $query->where('tanggal_warta', 'LIKE', '%' . $search . '%');
                            })
                            ->paginate(10);

        return response()->json([
            'success' => true,
            'data' => WartaJemaatResource::collection($banyak_warta_jemaat)->response()->getData(true),
        ], 200);
    }

    public function store(WartaJemaatRequest $request)
    {
        DB::beginTransaction();

        try {
            $input = $request->toArray();
            $input['file_warta'] = handleUploadedFile($request->file_warta, 'wartajemaat/');
            $wartajemaat = WartaJemaat::create($input);
            
            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Warta Jemaat berhasil dibuat',
                'data' => new WartaJemaatResource($wartajemaat),
            ], 201);

        } catch (\Exception $e) {
            DB::rollback();

            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 422);
        }
    }

    public function update(WartaJemaatUpdateRequest $request, $id_warta)
    {
        $wartajemaat = WartaJemaat::find($id_warta);

        if (!$wartajemaat )
            return response()->json([
                'success' => false,
                'message' => 'Warta Jemaat tidak ditemukan',
            ], 404);

        DB::beginTransaction();

        try {
            $input = $request->toArray();
            
            if ($request->file_warta) {
                handleDeletedFile($wartajemaat ->file_warta);
                $input['file_warta'] = handleUploadedFile($request->file_warta, 'wartajemaat/');
                

            }
            
            

            $wartajemaat ->update($input);
            
            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Warta Jemaat berhasil diperbaharui',
                'data' => new WartaJemaatResource($wartajemaat ),
            ], 200);

        } catch (\Exception $e) {
            DB::rollback();

            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 422);
        }
    }

    public function destroy($id_warta)
    {
        $wartajemaat = WartaJemaat::find($id_warta);

        if (!$wartajemaat )
            return response()->json([
                'success' => false,
                'message' => 'Warta Jemaat tidak ditemukan',
            ], 404);

        DB::beginTransaction();

        try {
            handleDeletedFile($wartajemaat ->file_warta);
           

            $wartajemaat ->delete();
            
            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Warta Jemaat berhasil dihapus',
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
