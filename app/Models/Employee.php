<?php

namespace App\Models;

use App\Models\Organization\Company;
use App\Models\Organization\Division;
use App\Models\Organization\Echelon;
use App\Models\Organization\Grade;
use App\Models\Organization\Position;
use App\Models\Organization\Region;
use App\Models\Organization\Unit;
use App\Models\Recruitment\FpsRequest;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use SoftDeletes;
    protected $guarded = ['id'];

    protected $casts = [
        'join_date' => 'date',
        'is_active' => 'boolean',
    ];

    /**
     * Relasi ke Akun Login (User)
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi ke Company
     */
    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * Relasi ke Region (Wilayah)
     */
    public function region(): BelongsTo
    {
        return $this->belongsTo(Region::class);
    }

    /**
     * Relasi ke Division (Divisi)
     */
    public function division(): BelongsTo
    {
        return $this->belongsTo(Division::class);
    }

    /**
     * Relasi ke Unit (Unit Kerja)
     */
    public function unit(): BelongsTo
    {
        return $this->belongsTo(Unit::class);
    }

    /**
     * Relasi ke Position (Jabatan)
     */
    public function position(): BelongsTo
    {
        return $this->belongsTo(Position::class);
    }

    /**
     * Relasi ke Echelon (Eselon)
     */
    public function echelon(): BelongsTo
    {
        return $this->belongsTo(Echelon::class);
    }

    /**
     * Relasi ke Grade (Pangkat/Golongan)
     */
    public function grade(): BelongsTo
    {
        return $this->belongsTo(Grade::class);
    }

    /**
     * Relasi ke FPS Request (jika direkrut melalui FPS)
     */
    public function fpsRequest(): BelongsTo
    {
        return $this->belongsTo(FpsRequest::class);
    }

    /**
     * Nama Wilayah (accessor)
     */
    public function getRegionNameAttribute(): string
    {
        return $this->region?->name ?? 'N/A';
    }

    /**
     * Nama Divisi (accessor)
     */
    public function getDivisionNameAttribute(): string
    {
        return $this->division?->name ?? 'N/A';
    }

    /**
     * Nama Unit (accessor)
     */
    public function getUnitNameAttribute(): string
    {
        return $this->unit?->name ?? 'N/A';
    }

    /**
     * Nama Jabatan (accessor)
     */ 
    public function getPositionNameAttribute(): string
    {
        return $this->position?->name ?? 'N/A';
    }
}