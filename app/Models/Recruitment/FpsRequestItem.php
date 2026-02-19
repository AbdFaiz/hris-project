<?php

namespace App\Models\Recruitment;

use App\Models\Organization\Position;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FpsRequestItem extends Model
{
    protected $guarded = ['id'];

    protected $casts = [
        'request_quantity' => 'integer',
        'fulfilled_quantity' => 'integer',
        'need_work_desk' => 'boolean',
        'need_uniform' => 'boolean',
        'need_computer_laptop' => 'boolean',
        'need_email' => 'boolean',
    ];

    /**
     * Relationships
     */
    public function fpsRequest(): BelongsTo
    {
        return $this->belongsTo(FpsRequest::class);
    }

    public function position(): BelongsTo
    {
        return $this->belongsTo(Position::class);
    }

    /**
     * Accessors
     */
    public function getRemainingAttribute(): int
    {
        return $this->request_quantity - $this->fulfilled_quantity;
    }

    public function getIsFulfilledAttribute(): bool
    {
        return $this->remaining === 0;
    }

    public function getFulfillmentPercentageAttribute(): int
    {
        if ($this->request_quantity === 0) {
            return 0;
        }
        
        return (int) round(($this->fulfilled_quantity / $this->request_quantity) * 100);
    }

    /**
     * Get gender in Indonesian
     */
    public function getGenderLabelAttribute(): string
    {
        return match($this->gender) {
            'L' => 'Laki-laki',
            'P' => 'Perempuan',
            'Semua' => 'Laki-laki/Perempuan',
            default => $this->gender ?? 'Semua'
        };
    }

    /**
     * Get employment status in Indonesian
     */
    public function getEmploymentStatusLabelAttribute(): string
    {
        return match($this->employment_status) {
            'intern' => 'Pemagang',
            'contract' => 'Kontrak',
            'permanent' => 'Tetap',
            default => $this->employment_status
        };
    }

    /**
     * Get position name
     */
    public function getPositionNameAttribute(): string
    {
        return $this->position?->name ?? '-';
    }

    /**
     * Get equipment needs as formatted string
     */
    public function getEquipmentNeedsAttribute(): string
    {
        $needs = [];
        
        if ($this->need_work_desk) {
            $needs[] = 'Meja Kerja';
        }
        if ($this->need_uniform) {
            $needs[] = 'Seragam';
        }
        if ($this->need_computer_laptop) {
            $needs[] = 'Komputer/Laptop';
        }
        if ($this->need_email) {
            $needs[] = 'Email';
        }
        if ($this->other_needs) {
            $needs[] = $this->other_needs;
        }
        
        return empty($needs) ? '-' : implode(', ', $needs);
    }
}