<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Supply extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function industries()
    {
        return $this->belongsToMany(Industry::class);
    }

    public function brands()
    {
        return $this->hasMany(Brand::class);
    }

    public function benefits(): BelongsToMany
    {
        return $this->morphToMany(Benefit::class, 'model', 'model_has_benefits', 'model_id', 'benefit_id');
    }
}
