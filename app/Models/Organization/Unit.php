<?php

namespace App\Models\Organization;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Unit extends Model
{
    protected $guarded = ['id'];

    /**
     * Relasi ke Perusahaan
     */
    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * Relasi ke Divisi (Parent Langsung)
     */
    public function division(): BelongsTo
    {
        return $this->belongsTo(Division::class);
    }

    public function position()
    {
        return $this->hasMany(Position::class);
    }

    public function updater(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
