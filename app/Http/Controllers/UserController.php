<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search ?? null;
        
        $users = User::when($request->has('search'), function ($query) use ($search) {
                                $query->where('name', 'LIKE', '%' . $search . '%');
                            })
                            ->paginate(10);

        return response()->json([
            'success' => true,
            'data' => UserResource::collection($users)->response()->getData(true),
        ], 200);
    }

    public function store(UserRequest $request)
    {
        DB::beginTransaction();

        try {
            $input = $request->toArray();
            $user = User::create($input);
            
            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'User created',
                'data' => new UserResource($user),
            ], 201);

        } catch (\Exception $e) {
            DB::rollback();

            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 422);
        }
    }

    public function update(UserUpdateRequest $request, $userId)
    {
        $user = User::find($userId);

        if (!$user)
            return response()->json([
                'success' => false,
                'message' => 'User not found',
            ], 404);

        DB::beginTransaction();

        try {
            $input = $request->toArray();
            
            if ($request->image) {
                handleDeletedImage($user->image);
                $input['image'] = handleUploadedImage($request->image, 'User/');
            }

            $user->update($input);
            
            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'User updated',
                'data' => new UserResource($user),
            ], 200);

        } catch (\Exception $e) {
            DB::rollback();

            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 422);
        }
    }

    public function destroy($userId)
    {
        $user = User::find($userId);

        if (!$user)
            return response()->json([
                'success' => false,
                'message' => 'User not found',
            ], 404);

        DB::beginTransaction();

        try {
            handleDeletedImage($user->image);

            $user->delete();
            
            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'User deleted',
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
