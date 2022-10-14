<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function designation()
    {
        return $this->belongsTo(Designation::class);
    }

    public function period()
    {
        return $this->belongsTo(Period::class);
    }
}
