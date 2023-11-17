<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PresensiJemaat extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_presensi_jemaat';
    protected $guarded = [];
}