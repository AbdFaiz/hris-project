<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeAssignment extends Model
{
    protected $guarded = ['id'];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    public function division()
    {
        return $this->belongsTo(Division::class);
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function position()
    {
        return $this->belongsTo(Position::class);
    }

    public function echelon()
    {
        return $this->belongsTo(Echelon::class);
    }

    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }
}
