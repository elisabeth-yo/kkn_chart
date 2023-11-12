<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriPengguna extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_kategori_pengguna';
    protected $guarded = [];
}
