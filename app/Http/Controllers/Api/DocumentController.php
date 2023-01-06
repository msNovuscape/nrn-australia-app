<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiBaseController;
use Illuminate\Http\Request;
use App\Models\Document;
use App\Http\Resources\DocumentCollection;

class DocumentController extends ApiBaseController
{
    
    public function index()
    {
        $settings = Document::where('status', 1)->orderBy('id','desc')->get();
        return new DocumentCollection($settings);
    }

    

}
