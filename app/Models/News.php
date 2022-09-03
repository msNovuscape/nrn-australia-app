<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function nrn_news()
    {
        return $this->hasOne(NrnaNews::class,'news_id');
    }
    public function third_party_news()
    {
        return $this->hasOne(ThirdPartyNews::class,'news_id');
    }
}

