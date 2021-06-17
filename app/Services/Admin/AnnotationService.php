<?php

namespace App\Services\Admin;

use App\Repository\Admin\AnnotationRepository;
use Illuminate\Http\Request;

class AnnotationService {

    protected $annotationRepository;

    public function __construct()
    {
        $this->annotationRepository = new AnnotationRepository;
    }

    public function getAnnotation($annotationId)
    {
        return $this->annotationRepository->getAnnotation($annotationId);
    }

    public function createNewAnnotation(Request $request, $proceedingId)
    {
        return $this->annotationRepository->createNewAnnotation($request, $proceedingId);
    }

    public function updateAnnotation($data, $annotationId)
    {
        return $this->annotationRepository->updateAnnotation($data, $annotationId);
    }

    public function deleteAnnotation($annotationId)
    {
        return $this->annotationRepository->deleteAnnotation($annotationId);
    }
}