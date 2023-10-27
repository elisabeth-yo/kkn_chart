<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClientRequest;
use App\Http\Requests\ClientUpdateRequest;
use App\Http\Resources\ClientResource;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClientController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search ?? null;
        
        $clients = Client::when($request->has('search'), function ($query) use ($search) {
                                $query->where('title', 'LIKE', '%' . $search . '%');
                            })
                            ->paginate(10);

        return response()->json([
            'success' => true,
            'data' => ClientResource::collection($clients)->response()->getData(true),
        ], 200);
    }

    public function store(ClientRequest $request)
    {
        DB::beginTransaction();

        try {
            $input = $request->toArray();
            $input['image'] = handleUploadedImage($request->image, 'client/');

            $client = Client::create($input);
            
            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Client created',
                'data' => new ClientResource($client),
            ], 201);

        } catch (\Exception $e) {
            DB::rollback();

            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 422);
        }
    }

    public function update(ClientUpdateRequest $request, $clientId)
    {
        $client = Client::find($clientId);

        if (!$client)
            return response()->json([
                'success' => false,
                'message' => 'Client not found',
            ], 404);

        DB::beginTransaction();

        try {
            $input = $request->toArray();
            
            if ($request->image) {
                handleDeletedImage($client->image);
                $input['image'] = handleUploadedImage($request->image, 'client/');
            }

            $client->update($input);
            
            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Client updated',
                'data' => new ClientResource($client),
            ], 200);

        } catch (\Exception $e) {
            DB::rollback();

            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 422);
        }
    }

    public function destroy($clientId)
    {
        $client = Client::find($clientId);

        if (!$client)
            return response()->json([
                'success' => false,
                'message' => 'Client not found',
            ], 404);

        DB::beginTransaction();

        try {
            handleDeletedImage($client->image);

            $client->delete();
            
            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Client deleted',
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
