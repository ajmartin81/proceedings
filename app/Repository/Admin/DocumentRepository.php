<?php

namespace App\Repository\Admin;

use App\Models\Document;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class DocumentRepository {

    public function uploadDocument($request, $proceedingId)
    {
        if($request->hasFile('documento')){
            $file = $request->file('documento');
            $url = substr(encrypt($file->getClientOriginalName()),0,128). '.'.$file->getClientOriginalExtension();

            $data['title']  = $request->get('titulo');
            $data['name']   = $file->getClientOriginalName();
            $data['url']    = $url;
            $data['proceeding_id'] = $proceedingId;
            $data['user_id'] = Auth::id();

            if($request->get('visible')){
                $data['visible'] = intval($request->input('visible'));
            }
            
            if (Storage::putFileAs('public/'.$proceedingId.'/', $file, $url)){
                $document = Document::updateOrCreate($data);
            }
        }else{
            $document = null;
        }
        
        return $document;
    }

    public function getDocument($documentId)
    {
        $document = Document::findOrFail($documentId);
        
        return $document;
    }

    public function updateDocument($documentId)
    {
        $document = $this->getDocument($documentId);

        if($document->visible == 0){
            $document->update(['visible' => 1]);
        }else{
            $document->update(['visible' => 0]);
        }

        return $document;
    }

    public function deleteDocument($documentId)
    {
        $document = $this->getDocument($documentId);

        if (Storage::delete('public/'.$document->proceeding_id.'/'.$document->url)){
            $document->delete();
            return $document;
        }
    
        return null;
    }
    
    public function getDocumentsSinceLastLogin($userId)
    {
        $userRepository = new UserRepository;
        $user = $userRepository->getUserById($userId);

        $dateFrom = $user->last_login?$user->last_login:"2000-01-01";

        $documentsSinceLastLoginCount = Document::whereDate('created_at','>=',$dateFrom)->get()->count();

        return $documentsSinceLastLoginCount;
    }
}