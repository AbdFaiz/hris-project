<?php

namespace App\Models\Recruitment;

use App\Models\Employee;
use App\Models\Recruitment\FpsRequestItem;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class FpsRequest extends Model
{
    use SoftDeletes;

    protected $guarded = ['id'];

    protected $casts = [
        'request_date' => 'date',
        'needed_date' => 'date',
        'closed_at' => 'datetime',
    ];

    protected static function booted()
    {
        static::creating(function ($model) {
            if (Auth::check()) {
                $model->created_by = Auth::id();
            }
        });

        static::updating(function ($model) {
            if (Auth::check()) {
                $model->updated_by = Auth::id();
            }
        });
    }


    /**
     * Generate auto FPS number
     * Format: 001/ACS-HCM/FPS/I/2025
     */
    public static function generateFpsNumber(): string
    {
        $year = date('Y');
        $month = date('m');
        $romanMonth = self::getRomanMonth($month);
        
        $lastFps = self::whereYear('created_at', $year)
            ->whereMonth('created_at', $month)
            ->orderBy('id', 'desc')
            ->first();
        
        if ($lastFps) {
            $lastNumber = (int) explode('/', $lastFps->fps_number)[0];
            $newNumber = str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);
        } else {
            $newNumber = '001';
        }
        
        return "{$newNumber}/ACS-HCM/FPS/{$romanMonth}/{$year}";
    }

    private static function getRomanMonth($month): string
    {
        $romans = ['I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X', 'XI', 'XII'];
        return $romans[(int)$month - 1];
    }

    /**
     * Relationships
     */
    public function applicant(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'applicant_id');
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updater(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function items(): HasMany
    {
        return $this->hasMany(FpsRequestItem::class);
    }

    /**
     * Accessors
     */
    public function getTotalRequestQuantityAttribute(): int
    {
        return $this->items->sum('request_quantity');
    }

    public function getTotalFulfilledAttribute(): int
    {
        return $this->items->sum('fulfilled_quantity');
    }

    public function getTotalRemainingAttribute(): int
    {
        return $this->total_request_quantity - $this->total_fulfilled;
    }

    public function getIsFullyFulfilledAttribute(): bool
    {
        return $this->total_remaining === 0;
    }

    /**
     * Get request type in Indonesian
     */
    public function getRequestTypeLabelAttribute(): string
    {
        return match($this->request_type) {
            'addition' => 'Penambahan',
            'replacement' => 'Penggantian',
            default => $this->request_type
        };
    }

    /**
     * Get status in Indonesian
     */
    public function getStatusLabelAttribute(): string
    {
        return match($this->status) {
            'pending' => 'Menunggu',
            'approved' => 'Disetujui',
            'rejected' => 'Ditolak',
            default => $this->status
        };
    }

    /**
     * Get final status in Indonesian
     */
    public function getFinalStatusLabelAttribute(): string
    {
        return match($this->final_status) {
            'draft' => 'Draft',
            'active' => 'Aktif',
            'closed' => 'Selesai',
            'cancelled' => 'Dibatalkan',
            default => $this->final_status
        };
    }
}