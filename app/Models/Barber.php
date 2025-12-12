<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barber extends Model
{
    protected $fillable = [
        'name',
        'experience',
        'specialty',
        'bio',
        'photo',
        'rating',
        'is_active'
    ];

    protected $casts = [
        'rating' => 'decimal:2',
        'is_active' => 'boolean'
    ];

    public function getFormattedRatingAttribute()
    {
        return number_format($this->rating, 1);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
