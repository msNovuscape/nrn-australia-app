<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notice extends Model
{
    use HasFactory;

    public function nrn_notice()
    {
        return $this->hasOne(NrnaNotice::class,'notice_id');
    }
    public function third_party_notice()
    {
        return $this->hasOne(ThirdPartyNotice::class,'notice_id');
    }
}
