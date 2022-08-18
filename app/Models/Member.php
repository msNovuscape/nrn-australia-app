<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Member extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function saveImage($document,$folder)
    {
        $filePath = public_path() . '/images/'.$folder;
        if (!is_dir($filePath)) {
            mkdir($filePath, 0777, true);
        }
        $filename = Carbon::now()->timestamp(). '_' . $document->getClientOriginalName();
        if ($document->move($filePath, $filename)) {
            return $filePath.'/'.$filename;
        }
        return null;
    }
    public function member_document()
    {
        return $this->hasOne(MemberDocument::class);
    }
}
