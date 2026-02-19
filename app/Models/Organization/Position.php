<?php

namespace App\Models\Organization;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Permission\Models\Role;

class Position extends Model
{
    protected $guarded = ['id'];

    /**
     * Relasi ke Atasan (Parent Position)
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(Position::class, 'parent_id');
    }

    /**
     * Relasi ke Bawahan (Child Positions)
     */
    public function children(): HasMany
    {
        return $this->hasMany(Position::class, 'parent_id');
    }

    /**
     * Relasi ke Company
     */
    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * Relasi ke Division
     */
    public function division(): BelongsTo
    {
        return $this->belongsTo(Division::class);
    }

    /**
     * Relasi ke Unit
     */
    public function unit(): BelongsTo
    {
        return $this->belongsTo(Unit::class);
    }

    /**
     * Relasi ke Employees (Karyawan yang memiliki jabatan ini)
     * Note: Ini adalah relasi hasMany karena satu jabatan bisa diisi banyak karyawan
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
     * Relasi ke Roles (Spatie Permission)
     */
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'position_role');
    }
}