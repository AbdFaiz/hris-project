<?php

namespace App\Models\Organization;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class Position extends Model
{
    protected $guarded = ['id'];

    // Relasi ke Atasan
    public function parent(): BelongsTo
    {
        return $this->belongsTo(Position::class, 'parent_id');
    }

    // Relasi ke Bawahan
    public function children(): HasMany
    {
        return $this->hasMany(Position::class, 'parent_id');
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function division(): BelongsTo
    {
        return $this->belongsTo(Division::class);
    }

    public function unit(): BelongsTo
    {
        return $this->belongsTo(Unit::class);
    }

    public function employees()
{
    // Loncat dari Position ke Employee melalui EmployeeAssignment
    return $this->hasManyThrough(
        \App\Models\Employee::class,
        \App\Models\EmployeeAssignment::class,
        'position_id', // Foreign key di tabel assignments
        'id',          // Local key di tabel employees
        'id',          // Local key di tabel positions
        'employee_id'  // Foreign key di tabel assignments yang merujuk ke employee
    )->where('employee_assignments.is_current', true); // Hanya ambil yang menjabat saat ini
}

    public function updater(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'position_role');
    }
}
