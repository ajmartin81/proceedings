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

    public function createNewAnnotation(Request $request, $proceedingId)
    {
        return $this->annotationRepository->createNewAnnotation($request, $proceedingId);
    }
}