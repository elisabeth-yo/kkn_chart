<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisIbadah extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_jenis_ibadah';
    protected $guarded = [];
}
