<?php

namespace App\Services\Admin;

use App\Repository\Admin\DocumentRepository;

class DocumentService {
    protected $documentRepository;

    public function __construct()
    {
        $this->documentRepository = new DocumentRepository;
    }

    public function uploadDocument($request, $proceedingId)
    {
        return $this->documentRepository->uploadDocument($request, $proceedingId);
    }

    public function getDocument($documentId)
    {
        return $this->documentRepository->getDocument($documentId);
    }
}