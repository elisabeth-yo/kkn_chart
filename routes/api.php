<?php

use App\Http\Controllers\API\LoginController;
use App\Http\Controllers\BenefitController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\FrontEndController;
use App\Http\Controllers\HomeSettingController;
use App\Http\Controllers\IndustryController;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SupplyController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\WilayahController;
use App\Http\Controllers\KategoriPenggunaController;
use App\Http\Controllers\BeritaKegiatanController;
use App\Http\Controllers\JadwalIbadahController;
use App\Http\Controllers\WartaJemaatController;
use App\Http\Controllers\PersembahanController;
use App\Http\Controllers\JenisIbadahController;
use App\Http\Controllers\PublikasiRenunganController;
use App\Http\Controllers\PresensiJemaatController;
use App\Http\Controllers\RenunganHarianController;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::group(['prefix' => 'admin', 'middleware' => []], function () {
    Route::post('login', [LoginController::class, 'login']);
    
    Route::group(['middleware' => ['auth:sanctum']], function () {    
        Route::post('logout', [LoginController::class, 'logout']);
        
        Route::group(['prefix' => 'industries', 'as' => 'industries.', 'middleware' => []], function () {
            Route::get('/', [IndustryController::class, 'index'])->name('index');
            Route::get('/{industryId}', [IndustryController::class, 'show'])->name('show');
            Route::post('store', [IndustryController::class, 'store'])->name('store');
            Route::patch('/update/{industryId}', [IndustryController::class, 'update'])->name('update');
            Route::patch('/update-supply/{industryId}', [IndustryController::class, 'updateSupply'])->name('update-supply');
            Route::patch('/update-benefit/{industryId}', [IndustryController::class, 'updateBenefit'])->name('update-benefit');
            Route::delete('/destroy/{industryId}', [IndustryController::class, 'destroy'])->name('destroy');
        });
        
        Route::group(['prefix' => 'supplies', 'as' => 'supplies.', 'middleware' => []], function () {
            Route::get('/', [SupplyController::class, 'index'])->name('index');
            Route::get('/{supplyId}', [SupplyController::class, 'show'])->name('show');
            Route::post('store', [SupplyController::class, 'store'])->name('store');
            Route::patch('/update/{supplyId}', [SupplyController::class, 'update'])->name('update');
            Route::patch('/update-benefit/{industryId}', [SupplyController::class, 'updateBenefit'])->name('update-benefit');
            Route::delete('/destroy/{supplyId}', [SupplyController::class, 'destroy'])->name('destroy');
        });

        Route::group(['prefix' => 'benefits', 'as' => 'benefits.', 'middleware' => []], function () {
            Route::get('/', [BenefitController::class, 'index'])->name('index');
            Route::get('/{benefitId}', [BenefitController::class, 'show'])->name('show');
            Route::post('store', [BenefitController::class, 'store'])->name('store');
            Route::patch('/update/{benefitId}', [BenefitController::class, 'update'])->name('update');
            Route::delete('/destroy/{benefitId}', [BenefitController::class, 'destroy'])->name('destroy');
        });

        Route::group(['prefix' => 'users', 'as' => 'users.', 'middleware' => []], function () {
            Route::get('/', [UserController::class, 'index'])->name('index');
            Route::get('/{userId}', [UserController::class, 'show'])->name('show');
            Route::post('store', [UserController::class, 'store'])->name('store');
            Route::patch('/update/{userId}', [UserController::class, 'update'])->name('update');
            Route::delete('/destroy/{userId}', [UserController::class, 'destroy'])->name('destroy');
        });

        Route::group(['prefix' => 'pengguna', 'as' => 'pengguna.', 'middleware' => []], function () {
            Route::get('/', [PenggunaController::class, 'index'])->name('index');
            Route::get('/{id_pengguna}', [PenggunaController::class, 'show'])->name('show');
            Route::post('store', [PenggunaController::class, 'store'])->name('store');
            Route::patch('/update/{id_pengguna}', [PenggunaController::class, 'update'])->name('update');
            Route::delete('/destroy/{id_pengguna}', [PenggunaController::class, 'destroy'])->name('destroy');
        });

        Route::group(['prefix' => 'wilayah', 'as' => 'wilayah.', 'middleware' => []], function () {
            Route::get('/', [WilayahController::class, 'index'])->name('index');
            Route::get('/{id_wilayah}', [WilayahController::class, 'show'])->name('show');
            Route::post('store', [WilayahController::class, 'store'])->name('store');
            Route::patch('/update/{id_wilayah}', [WilayahController::class, 'update'])->name('update');
            Route::delete('/destroy/{id_wilayah}', [WilayahController::class, 'destroy'])->name('destroy');
        });

        Route::group(['prefix' => 'kategoripengguna', 'as' => 'kategoripengguna.', 'middleware' => []], function () {
            Route::get('/', [KategoriPenggunaController::class, 'index'])->name('index');
            Route::get('/{id_kategori_pengguna}', [KategoriPenggunaController::class, 'show'])->name('show');
            Route::post('store', [KategoriPenggunaController::class, 'store'])->name('store');
            Route::patch('/update/{id_kategori_pengguna}', [KategoriPenggunaController::class, 'update'])->name('update');
            Route::delete('/destroy/{id_kategori_pengguna}', [KategoriPenggunaController::class, 'destroy'])->name('destroy');
        });

        Route::group(['prefix' => 'beritakegiatan', 'as' => 'beritakegiatan.', 'middleware' => []], function () {
            Route::get('/', [BeritaKegiatanController::class, 'index'])->name('index');
            Route::get('/{id_berita}', [BeritaKegiatanController::class, 'show'])->name('show');
            Route::post('store', [BeritaKegiatanController::class, 'store'])->name('store');
            Route::patch('/update/{id_berita}', [BeritaKegiatanController::class, 'update'])->name('update');
            Route::delete('/destroy/{id_berita}', [BeritaKegiatanController::class, 'destroy'])->name('destroy');
        });

        Route::group(['prefix' => 'jadwalibadah', 'as' => 'jadwalibadah.', 'middleware' => []], function () {
            Route::get('/', [JadwalIbadahController::class, 'index'])->name('index');
            Route::get('/{id_jadwal_ibadah}', [JadwalIbadahController::class, 'show'])->name('show');
            Route::post('store', [JadwalIbadahController::class, 'store'])->name('store');
            Route::patch('/update/{id_jadwal_ibadah}', [JadwalIbadahController::class, 'update'])->name('update');
            Route::delete('/destroy/{id_jadwal_ibadah}', [JadwalIbadahController::class, 'destroy'])->name('destroy');
        });

        Route::group(['prefix' => 'wartajemaat', 'as' => 'wartajemaat.', 'middleware' => []], function () {
            Route::get('/', [WartaJemaatController::class, 'index'])->name('index');
            Route::get('/{id_jadwal_ibadah}', [WartaJemaatController::class, 'show'])->name('show');
            Route::post('store', [WartaJemaatController::class, 'store'])->name('store');
            Route::patch('/update/{id_warta}', [WartaJemaatController::class, 'update'])->name('update');
            Route::delete('/destroy/{id_warta}', [WartaJemaatController::class, 'destroy'])->name('destroy');
        });

        Route::group(['prefix' => 'persembahan', 'as' => 'persembahan.', 'middleware' => []], function () {
            Route::get('/', [PersembahanController::class, 'index'])->name('index');
            Route::get('/{id_persembahan}', [PersembahanController::class, 'show'])->name('show');
            Route::post('store', [PersembahanController::class, 'store'])->name('store');
            Route::patch('/update/{id_persembahan}', [PersembahanController::class, 'update'])->name('update');
            Route::delete('/destroy/{id_persembahan}', [PersembahanController::class, 'destroy'])->name('destroy');
        });

        Route::group(['prefix' => 'jenisibadah', 'as' => 'jenisibadah.', 'middleware' => []], function () {
            Route::get('/', [JenisIbadahController::class, 'index'])->name('index');
            Route::get('/{id_jenis_ibadah}', [JenisIbadahController::class, 'show'])->name('show');
            Route::post('store', [JenisIbadahController::class, 'store'])->name('store');
            Route::patch('/update/{id_jenis_ibadah}', [JenisIbadahController::class, 'update'])->name('update');
            Route::delete('/destroy/{id_jenis_ibadah}', [JenisIbadahController::class, 'destroy'])->name('destroy');
        });

        Route::group(['prefix' => 'publikasirenungan', 'as' => 'publikasirenungan.', 'middleware' => []], function () {
            Route::get('/', [PublikasiRenunganController::class, 'index'])->name('index');
            Route::get('/{id_publikasi_renungan}', [PublikasiRenunganController::class, 'show'])->name('show');
            Route::post('store', [PublikasiRenunganController::class, 'store'])->name('store');
            Route::patch('/update/{id_publikasi_renungan}', [PublikasiRenunganController::class, 'update'])->name('update');
            Route::delete('/destroy/{id_publikasi_renungan}', [PublikasiRenunganController::class, 'destroy'])->name('destroy');
        });

        Route::group(['prefix' => 'presensijemaat', 'as' => 'presensijemaat.', 'middleware' => []], function () {
            Route::get('/', [PresensiJemaatController::class, 'index'])->name('index');
            Route::get('/{id_presensi_jemaat}', [PresensiJemaatController::class, 'show'])->name('show');
            Route::post('store', [PresensiJemaatController::class, 'store'])->name('store');
            Route::patch('/update/{id_presensi_jemaat}', [PresensiJemaatController::class, 'update'])->name('update');
            Route::delete('/destroy/{id_presensi_jemaat}', [PresensiJemaatController::class, 'destroy'])->name('destroy');
        });

        Route::group(['prefix' => 'renunganharian', 'as' => 'renunganharian.', 'middleware' => []], function () {
            Route::get('/', [RenunganHarianController::class, 'index'])->name('index');
            Route::get('/{id_judul}', [RenunganHarianController::class, 'show'])->name('show');
            Route::post('store', [RenunganHarianController::class, 'store'])->name('store');
            Route::patch('/update/{id_judul}', [RenunganHarianController::class, 'update'])->name('update');
            Route::delete('/destroy/{id_judul}', [RenunganHarianController::class, 'destroy'])->name('destroy');
        });


        Route::group(['prefix' => 'clients', 'as' => 'clients.', 'middleware' => []], function () {
            Route::get('/', [ClientController::class, 'index'])->name('index');
            Route::get('/{clientId}', [ClientController::class, 'show'])->name('show');
            Route::post('store', [ClientController::class, 'store'])->name('store');
            Route::patch('/update/{clientId}', [ClientController::class, 'update'])->name('update');
            Route::delete('/destroy/{clientId}', [ClientController::class, 'destroy'])->name('destroy');
        });

        Route::group(['prefix' => 'partners', 'as' => 'partners.', 'middleware' => []], function () {
            Route::get('/', [PartnerController::class, 'index'])->name('index');
            Route::get('/{partnerId}', [PartnerController::class, 'show'])->name('show');
            Route::post('store', [PartnerController::class, 'store'])->name('store');
            Route::patch('/update/{partnerId}', [PartnerController::class, 'update'])->name('update');
            Route::delete('/destroy/{partnerId}', [PartnerController::class, 'destroy'])->name('destroy');
        });
        
        Route::group(['prefix' => 'brands', 'as' => 'brands.', 'middleware' => []], function () {
            Route::get('/all/{supplyId}', [BrandController::class, 'index'])->name('index');
            Route::get('/{brandId}', [BrandController::class, 'show'])->name('show');
            Route::post('store', [BrandController::class, 'store'])->name('store');
            Route::patch('/update/{brandId}', [BrandController::class, 'update'])->name('update');
            Route::delete('/destroy/{brandId}', [BrandController::class, 'destroy'])->name('destroy');
        });
        
        Route::group(['prefix' => 'products', 'as' => 'products.', 'middleware' => []], function () {
            Route::get('all/{brandId}', [ProductController::class, 'index'])->name('index');
            Route::get('/{productId}', [ProductController::class, 'show'])->name('show');
            Route::post('store', [ProductController::class, 'store'])->name('store');
            Route::patch('/update/{productId}', [ProductController::class, 'update'])->name('update');
            Route::delete('/destroy/{productId}', [ProductController::class, 'destroy'])->name('destroy');
        });
        
        Route::group(['prefix' => 'home-settings', 'as' => 'home-settings.', 'middleware' => []], function () {
            Route::get('/', [HomeSettingController::class, 'index'])->name('index');
            Route::get('/{homeSettingId}', [HomeSettingController::class, 'show'])->name('show');
            Route::post('store', [HomeSettingController::class, 'store'])->name('store');
            Route::patch('/update/{homeSettingId}', [HomeSettingController::class, 'update'])->name('update');
            Route::delete('/destroy/{homeSettingId}', [HomeSettingController::class, 'destroy'])->name('destroy');
        });
    });
});


Route::get('frontend/home', [FrontEndController::class, 'index']);
Route::get('frontend/industries', [FrontEndController::class, 'getIndustry']);
Route::get('frontend/industries/get/{industryCode}', [FrontEndController::class, 'getIndustryByCode']);
Route::get('frontend/supplies/get/{supplyCode}', [FrontEndController::class, 'getSupplyByCode']);
Route::get('frontend/contact-us/get', [FrontEndController::class, 'getContactUs']);

Route::post('frontend/send-inquiry', [FrontEndController::class, 'sendInquiry'])->middleware([
    'throttle:3,10'
]);
