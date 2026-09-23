<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Railway extends Model
{
    protected $fillable = [
        'name',
    ];
    public function stations(): HasMany
    {
        return $this->hasMany(Station::class);
    }
    public function trains(): HasMany
    {
        return $this->hasMany(Train::class);
    }
}
