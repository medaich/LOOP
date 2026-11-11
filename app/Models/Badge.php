<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Badge extends Model
{
    protected $fillable = [
        'name',
        'description',
        'icon_url',
        'criteria_type',
        'criteria_value',
        'rarity',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_badges')->withPivot('awarded_at')->withTimestamps();
    }
}
