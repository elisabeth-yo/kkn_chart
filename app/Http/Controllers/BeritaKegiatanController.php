<?php

namespace App\Http\Controllers;


use App\Http\Requests\BeritaKegiatanRequest;
use App\Http\Requests\BeritaKegiatanUpdateRequest;
use App\Http\Resources\BeritaKegiatanResource;
use App\Models\BeritaKegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BeritaKegiatanController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search ?? null;
        
        $banyak_berita_kegiatan = BeritaKegiatan::when($request->has('search'), function ($query) use ($search) {
                                $query->where('nama_kegiatan', 'LIKE', '%' . $search . '%');
                            })
                            ->paginate(10);

        return response()->json([
            'success' => true,
            'data' => BeritaKegiatanResource::collection($banyak_berita_kegiatan)->response()->getData(true),
        ], 200);
    }

    public function store(BeritaKegiatanRequest $request)
    {
        DB::beginTransaction();

        try {
            $input = $request->toArray();
            $input['poster_kegiatan'] = handleUploadedImage($request->poster_kegiatan, 'beritakegiatan/');
            $input['foto_kegiatan'] = handleUploadedImage($request->foto_kegiatan, 'beritakegiatan/');
            $beritakegiatan = BeritaKegiatan::create($input);
            
            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Berita Kegiatan berhasil dibuat',
                'data' => new BeritaKegiatanResource($beritakegiatan),
            ], 201);

        } catch (\Exception $e) {
            DB::rollback();

            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 422);
        }
    }

    public function update(BeritaKegiatanUpdateRequest $request, $id_berita)
    {
        $beritakegiatan = BeritaKegiatan::find($id_berita);

        if (!$beritakegiatan )
            return response()->json([
                'success' => false,
                'message' => 'Berita Kegiatan tidak ditemukan',
            ], 404);

        DB::beginTransaction();

        try {
            $input = $request->toArray();
            
            if ($request->poster_kegiatan) {
                handleDeletedImage($beritakegiatan ->poster_kegiatan);
                $input['poster_kegiatan'] = handleUploadedImage($request->poster_kegiatan, 'beritakegiatan/');
                

            }
            
            if ($request->foto_kegiatan) {
                handleDeletedImage($beritakegiatan ->foto_kegiatan);
                $input['foto_kegiatan'] = handleUploadedImage($request->foto_kegiatan, 'beritakegiatan/');

            }

            $beritakegiatan ->update($input);
            
            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Berita Kegiatan berhasil diperbaharui',
                'data' => new BeritaKegiatanResource($beritakegiatan ),
            ], 200);

        } catch (\Exception $e) {
            DB::rollback();

            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 422);
        }
    }

    public function destroy($id_berita)
    {
        $beritakegiatan = BeritaKegiatan::find($id_berita);

        if (!$beritakegiatan )
            return response()->json([
                'success' => false,
                'message' => 'Berita Kegiatan tidak ditemukan',
            ], 404);

        DB::beginTransaction();

        try {
            handleDeletedImage($beritakegiatan ->poster_kegiatan);
            handleDeletedImage($beritakegiatan ->foto_kegiatan);

            $beritakegiatan ->delete();
            
            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Berita Kegitan berhasil dihapus',
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