<?php

namespace App\Repository\Admin;

use App\Models\Document;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DocumentRepository {

    public function uploadDocument(Request $request, $proceedingId)
    {
        if($request->hasFile('documento')){
            $file = $request->file('documento');
            $url = substr(encrypt($file->getClientOriginalName()),0,128). '.'.$file->getClientOriginalExtension();

            $data['title']  = $request->get('titulo');
            $data['name']   = $file->getClientOriginalName();
            $data['url']    = $url;
            $data['proceeding_id'] = $proceedingId;
            $data['user_id'] = Auth::id();

            if (Storage::putFileAs('/public/'.$proceedingId.'/', $file, $url)){
                $document = Document::updateOrCreate($data);
            }
        }else{
            $document = null;
        }
        
        return $document;
    }
    
}