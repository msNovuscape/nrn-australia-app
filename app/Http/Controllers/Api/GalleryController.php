<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiBaseController;
use Illuminate\Http\Request;
use App\Models\Gallery;
use App\Http\Resources\GalleryResource;

class GalleryController extends ApiBaseController
{
    
    public function index(Request $request){

        if(\request('per_page')){
            $perpage = request('per_page');
        }else{
            $perpage = config('custom.per_page');
        }
        $settings = Gallery::where('status',1)->with('gallery_images')->orderBy('id','desc')->paginate($perpage);
        return GalleryResource::collection($settings);

    }

    // public function show($id)
    // {
    //     $setting = Gallery::findOrFail($id);
    //     return new GalleryResource($setting);
    // }
}
