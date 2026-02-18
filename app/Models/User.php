<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasRoles, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function employee()
    {
        return $this->hasOne(Employee::class);
    }

    // Di dalam model User.php
    public function syncRolesFromPosition()
    {
        // 1. Cari jabatan user ini lewat relasi employee
        $position = $this->employee->currentAssignment?->position;

        if ($position) {
            // 2. Ambil semua role yang terdaftar di jabatan tersebut
            $roles = $position->roles->pluck('name')->toArray();
            
            // 3. Masukkan ke fungsi standar Spatie
            $this->syncRoles($roles); // Fungsi bawaan Spatie tetap dipakai
        }
    }
}
