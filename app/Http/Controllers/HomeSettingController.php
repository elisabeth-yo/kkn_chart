<?php

namespace App\Http\Controllers;

use App\Http\Requests\HomeSettingRequest;
use App\Http\Requests\HomeSettingUpdateRequest;
use App\Http\Resources\HomeSettingResource;
use App\Models\HomeSetting;
use App\Services\HomeSettingService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeSettingController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search ?? null;
        $keys = $request->keys ?? null;

        $homeSettings = HomeSetting::when($request->has('search'), function ($query) use ($search) {
                                        $query->where(function ($q1) use ($search) {
                                            $q1->orWhere('key', 'LIKE', "%$search%")
                                                ->orWhere('title', 'LIKE', "%$search%")
                                                ->orWhere('description', 'LIKE', "%$search%")
                                                ->orWhere('content', 'LIKE', "%$search%");
                                        });
                                    })
                                    ->when($keys, function ($query) use ($keys) {
                                        $query->where('key', $keys);
                                    })
                                    ->paginate(10);

        return response()->json([
            'success' => true,
            'data' => HomeSettingResource::collection($homeSettings)->response()->getData(true)
        ], 200);
    }

    public function store(HomeSettingRequest $request)
    {
        return (new HomeSettingService)->store($request);
    }

    public function show($homeSetting) 
    {
        
    }

    public function update(HomeSettingUpdateRequest $request, $homeSettingId)
    {
        return (new HomeSettingService)->update($request, $homeSettingId);
    }

    public function destroy($homeSettingId)
    {
        return (new HomeSettingService)->destroy($homeSettingId);
    }
}
