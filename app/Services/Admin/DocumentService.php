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

    public function updateDocument($documentId)
    {
        return $this->documentRepository->updateDocument($documentId);
    }

    public function deleteDocument($documentId)
    {
        return $this->documentRepository->deleteDocument($documentId);
    }

    public function getDocumentsSinceLastLogin($userId)
    {
        return $this->documentRepository->getDocumentsSinceLastLogin($userId);
    }
}