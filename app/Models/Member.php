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
        // $filePath = public_path() . '/images/'.$folder;
        // if (!is_dir($filePath)) {
        //     mkdir($filePath, 0777, true);
        // }
        // $filename = Carbon::now()->timestamp. '_'. $document->getClientOriginalName();
        // if ($document->move($filePath, $filename)) {
        //     return $filePath.'/'.$filename;
        // }
        // return null;

        $extension = $document->getClientOriginalExtension();
        $image_folder_type = array_search($folder,config('custom.image_folders')); //for image saved in folder
        $count = rand(1000,9999).date('Y-m-d');
        $directory = User::makeDirectory($image_folder_type);
        $file_name = $count.'_'.$folder.'.'.$extension;
        
        if($document->move($directory,$file_name)){
          $image_path1 = $directory.$file_name;
          return $image_path1;
        }
        return null;
    }
    public function member_document()
    {
        return $this->hasOne(MemberDocument::class);
    }
    public function member_payment()
    {
        return $this->hasOne(MemberPayment::class);
    }

    public function membership_type(){
        return $this->belongsTo(MembershipType::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
