<?php

namespace App\Http\Controllers;

use App\Http\Requests\PersembahanRequest;
use App\Http\Requests\PersembahanUpdateRequest;
use App\Http\Resources\PersembahanResource;
use App\Models\Persembahan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PersembahanController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search ?? null;
        
        $banyak_persembahan = Persembahan::when($request->has('search'), function ($query) use ($search) {
                                $query->where('id_persembahan', 'LIKE', '%' . $search . '%');
                            })
                            ->paginate(10);

        return response()->json([
            'success' => true,
            'data' => PersembahanResource::collection($banyak_persembahan)->response()->getData(true),
        ], 200);
    }

    public function store(PersembahanRequest $request)
    {
        DB::beginTransaction();

        try {
            $input = $request->toArray();
            
            $persembahan = Persembahan::create($input);
            
            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Persembahan berhasil dibuat',
                'data' => new PersembahanResource($persembahan),
            ], 201);

        } catch (\Exception $e) {
            DB::rollback();

            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 422);
        }
    }

    public function update(PersembahanUpdateRequest $request, $id_persembahan)
    {
        $persembahan = Persembahan::find($id_persembahan);

        if (!$persembahan )
            return response()->json([
                'success' => false,
                'message' => 'Persembahan tidak ditemukan',
            ], 404);

        DB::beginTransaction();

        try {
            $input = $request->toArray();
            
            

            $persembahan ->update($input);
            
            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Persembahan berhasil diperbaharui',
                'data' => new PersembahanResource($persembahan ),
            ], 200);

        } catch (\Exception $e) {
            DB::rollback();

            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 422);
        }
    }

    public function destroy($id_persembahan)
    {
        $persembahan = Persembahan::find($id_persembahan);

        if (!$persembahan )
            return response()->json([
                'success' => false,
                'message' => 'Persembahan tidak ditemukan',
            ], 404);

        DB::beginTransaction();

        try {
           

            $persembahan ->delete();
            
            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Persembahan berhasil dihapus',
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