<?php

namespace App\Repository\Admin;

use App\Models\Annotation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnnotationRepository {

    public function getProceedingAnnotationsById($proceedingId)
    {
        $annotations = Annotation::where('proceeding_id', $proceedingId)->get();
        return $annotations;
    }

    public function createNewAnnotation(Request $request, $proceedingId)
    {
        $data['title']  = $request->get('titulo');
        $data['description']   = $request->get('descripcion');
        $data['proceeding_id'] = $proceedingId;
        $data['user_id'] = Auth::id();

        $annotation = Annotation::updateOrCreate($data);

        return $annotation;
    }
}