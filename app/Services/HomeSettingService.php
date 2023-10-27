<?php

namespace App\Services;

use Illuminate\Support\Arr;

use App\Http\Resources\HomeSettingResource;
use App\Models\Brand;
use App\Models\HomeSetting;
use Illuminate\Support\Facades\DB;

class HomeSettingService {
 
    protected $staticKeys = [
        'achievement_result',
        'contact_us'
    ];

    public function store($homeSettingData)
    {
        DB::beginTransaction();
        
        try {
            $input = $homeSettingData->toArray();

            $input['description'] = $homeSettingData->description !== 'null' ? $homeSettingData->description : null;
            $input['content'] = $homeSettingData->content !== 'null' ? $homeSettingData->content : null;
            $input['image'] = $homeSettingData->image !== 'null' ? $homeSettingData->image : null;

            if ($homeSettingData->file('image')) {
                $input['image'] = handleUploadedImage($homeSettingData->image, 'home_setting/');
            }

            $homeSetting = HomeSetting::create($input);
            
            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Home Setting created',
                'data' => new HomeSettingResource($homeSetting),
            ], 201);
        } catch (\Exception $e) {
            DB::rollback();

            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 422);
        }
    }

    public function update($homeSettingData, $homeSettingId)
    {
        $homeSetting = HomeSetting::find($homeSettingId);

        if (!$homeSetting)
            return response()->json([
                'success' => false,
                'message' => 'Home Setting not found',
            ], 404);

        DB::beginTransaction();

        try {
            $oldImage = $homeSetting->image;

            $homeSetting->update(
                $this->handleUpdateData($homeSettingData, $oldImage)
            );
            
            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Brand updated',
                'data' => new HomeSettingResource($homeSetting),
            ], 200);

        } catch (\Exception $e) {
            DB::rollback();

            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 422);
        }
    }

    public function destroy($homeSettingId)
    {
        $homeSetting = HomeSetting::find($homeSettingId);

        if (!$homeSetting)
            return response()->json([
                'success' => false,
                'message' => 'Home Setting not found',
            ], 404);

        if (in_array($homeSetting->key, $this->staticKeys))
            return response()->json([
                'success' => false,
                'message' => "This key is static, can't to delete",
            ], 412);

        DB::beginTransaction();

        try {
            handleDeletedImage($homeSetting->image);

            $homeSetting->delete();
            
            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Home Setting deleted',
            ], 200);

        } catch (\Exception $e) {
            DB::rollback();

            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 422);
        }
    }

    private function handleUpdateData($data, $oldImage = null)
    {
        $input = [];
        
        switch ($data->key) {
            case ('achievement_result'):
                $input['content'] = $data->content ?? null;

                break;
            case ('contact_us'):
                $input['content'] = $data->content ?? null;

                break;
            default:
                $input = $data->toArray();
        
                $input['description'] = $data->description ?? null;
                $input['content'] = $data->content ?? null;
        }

        if ($data->image) {
            handleDeletedImage($oldImage);
            $input['image'] = handleUploadedImage($data->image, 'home_setting/');
        }

        return $input;
    }
}