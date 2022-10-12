<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiBaseController;
use Illuminate\Http\Request;
use App\Models\Document;
use App\Http\Resources\DocumentCollection;

class DocumentController extends ApiBaseController
{
    
    public function index(Request $request){
        // if(\request('per_page')){
        //     $perpage = request('per_page');
        // }
        // else{
        //     $perpage = config('custom.per_page');
        // }
        $settings = Document::where('status',1)->orderBy('id','desc')->get();
        return new DocumentCollection($settings);
    }

    // public function show($id)
    // {
    //     $setting = Gallery::findOrFail($id);
    //     return new GalleryResource($setting);
    // }
}
