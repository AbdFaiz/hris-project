<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $guarded = ['id'];

    // Relasi ke Akun Login
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // 2a. Relasi ke Data Detail (Pribadi/KTP/Alamat) - One to One
    public function detail()
    {
        return $this->hasOne(EmployeeDetail::class);
    }

    // 2e. Relasi ke Riwayat Penugasan (Promosi/Mutasi) - One to Many
    public function assignments()
    {
        return $this->hasMany(EmployeeAssignment::class);
    }

    // Mendapatkan Jabatan Aktif Saat Ini
    public function currentAssignment()
    {
        return $this->hasOne(EmployeeAssignment::class)->where('is_current', true);
    }

    public function getRegionNameAttribute()
{
    return $this->currentAssignment?->region?->name ?? 'N/A';
}

    // 2g. Relasi ke Riwayat Pelanggaran (ST/SP) - One to Many
    public function disciplinaryActions()
    {
        return $this->hasMany(DisciplinaryAction::class);
    }

    // 2b. Relasi ke Data Resign/PHK - One to One
    public function termination()
    {
        return $this->hasOne(EmployeeTermination::class);
    }
}
