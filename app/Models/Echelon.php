<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Echelon extends Model
{
    protected $guarded = ['id'];

    /**
     * Relasi ke User pemutakhir data (Admin Test di screenshot kamu)
     */
    public function updater(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
