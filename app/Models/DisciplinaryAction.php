<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DisciplinaryAction extends Model
{
    protected $guarded = ['id'];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function issuer()
    {
        return $this->belongsTo(User::class, 'issued_by');
    }
}
