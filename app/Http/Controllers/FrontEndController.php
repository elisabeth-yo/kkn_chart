<?php

namespace App\Http\Controllers;

use App\Http\Resources\ClientResource;
use App\Http\Resources\HomeSettingResource;
use App\Http\Resources\IndustryNavigationResource;
use App\Http\Resources\IndustryResource;
use App\Http\Resources\PartnerResource;
use App\Http\Resources\SupplyResource;
use App\Jobs\SendInquiry;
use App\Jobs\SendInquiryJob;
use App\Mail\Inquiry;
use App\Models\Client;
use App\Models\HomeSetting;
use App\Models\Industry;
use App\Models\Partner;
use App\Services\IndustryService;
use App\Services\SupplyService;
use Illuminate\Http\Request;
use Illuminate\Session\TokenMismatchException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class FrontEndController extends Controller
{
    public function index(Request $request)
    {
        $clients = Client::where('is_active', 1)->get();
        $partners = Partner::where('is_active', 1)->get();
        $homeSettings = HomeSetting::when($request->has('key'), function ($query) use ($request) {
                                        $query->where('key', $request->key);        
                                    })
                                    ->orderBy('title')->get();

        return response()->json([
            'success' => true,
            'data' => [
                'homeSettings' => HomeSettingResource::collection($homeSettings)->groupBy('key'),
                'clients' => ClientResource::collection($clients),
                'partners' => PartnerResource::collection($partners),
            ]
        ], 200);
    }

    public function getIndustryByCode($industryCode) 
    {
        $industry = (new IndustryService)->getIndustryByCode($industryCode);

        if (!$industry)
            return response()->json([
                'success' => false,
                'message' => 'Industry not found',
            ], 404);


        return response()->json([
                'success' => true,
                'data' => new IndustryResource($industry),
            ], 200);
    }

    public function getIndustry()
    {
        $industries = Industry::select('id', 'code', 'title')->get();

        return response()->json([
            'success' => true,
            'data' => IndustryNavigationResource::collection($industries),
        ], 200);
    }

    public function getSupplyByCode($supplyCode)
    {
        $supply = (new SupplyService)->getSupplyByCode($supplyCode);

        if (!$supply)
            return response()->json([
                'success' => false,
                'message' => 'Supply not found',
            ], 404);


        return response()->json([
                'success' => true,
                'data' => [
                    'supply' => new SupplyResource($supply),
                    'shipping_terms' => $this->getShippingTerms()
                ],
            ], 200);
    }

    public function getShippingTerms()
    {
        return HomeSetting::where('key', 'shipping_terms')->get();
    }

    public function getContactUs()
    {
        $contactUs = HomeSetting::where('key', 'contact_us')->get();

        $contactUs = [
            "address" => $contactUs->where('title', "address")->first()->content,
            "phone" => $contactUs->where('title', "phone")->first()->content,
            "email" => $contactUs->where('title', "email")->first()->content,
            "linkedin" => $contactUs->where('title', "linkedin")->first()->content,
        ];

        return response()->json([
            'success' => true,
            'data' => $contactUs,
        ], 200);
    }

    public function sendInquiry(Request $request)
    {
        $emailInquiries = HomeSetting::where('key', 'email_inquiry')->get();

        DB::beginTransaction();

        try {
            if ($emailInquiries) {
                foreach ($emailInquiries->pluck('content') as $recipient) {
                    Mail::to($recipient)->send(new Inquiry($request->all()));
                }
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Inquiry Submitted',
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
