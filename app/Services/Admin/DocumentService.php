<?php

namespace App\Services\Admin;

use App\Repository\Admin\DocumentRepository;
use Illuminate\Http\Request;

class DocumentService {
    protected $documentRepository;

    public function __construct()
    {
        $this->documentRepository = new DocumentRepository;
    }

    public function uploadDocument(Request $request, $proceedingId)
    {
        return $this->documentRepository->uploadDocument($request, $proceedingId);
    }
}