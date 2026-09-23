<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Train extends Model
{
    protected $fillable = [
        'railway_id',
        'train_no',
        'direction',
    ];

    public function railway(): BelongsTo
    {
        return $this->belongsTo(Railway::class);
    }

    public function timetableStops(): HasMany
    {
        return $this->hasMany(TimetableStop::class);
    }
}
