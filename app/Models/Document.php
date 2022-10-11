<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function document_category()
    {
        return $this->belongsTo(DocumentCategory::class);
    }
    public function period()
    {
        return $this->belongsTo(Period::class);
    }
}
