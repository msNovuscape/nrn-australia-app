<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiBaseController;
use Illuminate\Http\Request;
use App\Models\Guideline;
use App\Http\Resources\GuidelineResource;

class GuidelineController extends ApiBaseController
{
    
    public function index(Request $request){

        if(\request('per_page')){
            $perpage = request('per_page');
        }else{
            $perpage = config('custom.per_page');
        }
        $settings = Guideline::where('status',1)->orderBy('id','desc')->paginate($perpage);
        return GuidelineResource::collection($settings);

    }

    // public function show($id)
    // {
    //     $setting = Gallery::findOrFail($id);
    //     return new GalleryResource($setting);
    // }
}
