<?php

namespace App\Models\Organization;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Company extends Model
{
    protected $guarded = ['id'];

    /**
     * Relasi ke Divisions
     */
    public function divisions(): HasMany
    {
        return $this->hasMany(Division::class);
    }

    /**
     * Relasi ke Regions
     */
    public function regions(): HasMany
    {
        return $this->hasMany(Region::class);
    }

    /**
     * Relasi ke Employees
     */
    public function employees(): HasMany
    {
        return $this->hasMany(Employee::class);
    }

    /**
     * Relasi ke User pemutakhir data
     */
    public function updater(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    /**
     * Relasi ke Company Philosophy
     */
    public function philosophy(): HasOne
    {
        return $this->hasOne(CompanyPhilosophy::class);
    }
}