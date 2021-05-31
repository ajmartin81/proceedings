<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\ProceedingService;
use App\Services\Admin\DocumentService;
use App\Models\Document;
use App\Models\Proceeding;
use Illuminate\Http\Request;

class AdminDocumentController extends Controller
{
    protected $documentService;

    public function __construct()
    {
        $this->documentService = new DocumentService;
    }
    public function index()
    {
        //
    }

    public function create($proceedingId)
    {
        $proceedingService = new ProceedingService;
        $proceeding = new Proceeding;
        $proceeding = $proceedingService->getProceedingById($proceedingId);
        
        return view('admin.documents.upload', compact('proceeding'));
    }

    public function store(Request $request, $proceedingId)
    {
        $this->documentService->uploadDocument($request, $proceedingId);
        
        return redirect()->route('index');
    }

    public function show(Document $document)
    {
        //
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
