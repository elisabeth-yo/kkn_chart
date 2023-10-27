<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Industry extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function supplies()
    {
        return $this->belongsToMany(Supply::class);
    }

    public function benefits(): BelongsToMany
    {
        return $this->morphToMany(Benefit::class, 'model', 'model_has_benefits', 'model_id', 'benefit_id');
    }
}
