<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\ProceedingService;
use App\Services\Admin\DocumentService;
use App\Models\Document;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\DocumentRequest;
use Illuminate\Support\Facades\Auth;

class AdminDocumentController extends Controller
{
    protected $documentService;

    public function __construct()
    {
        $this->documentService = new DocumentService;
    }
    
    public function create($proceedingId)
    {
        $proceedingService = new ProceedingService;
        $proceeding = $proceedingService->getProceedingById($proceedingId);
        
        return view('admin.documents.upload', compact('proceeding'));
    }

    public function store(DocumentRequest $request, $proceedingId)
    {
        $this->documentService->uploadDocument($request, $proceedingId);

        return redirect()->route('proceeding.show', ['proceedingId' => $proceedingId]);
    }

    public function show($documentId)
    {
        
        $document = $this->documentService->getDocument($documentId);
        $user = User::find(Auth::id());

        if(Auth::id() == $document->user_id || $user->can('admin')){
            $documentPath = storage_path('app/public/'.$document->proceeding_id.'/'.$document->url);
            return response()->download($documentPath, $document->name);
        }
        
        return abort(403);
    }

    public function edit(Document $document)
    {
        //
    }

    public function update(Request $request, Document $document)
    {
        //
    }

    public function destroy(Document $document)
    {
        //
    }
}
