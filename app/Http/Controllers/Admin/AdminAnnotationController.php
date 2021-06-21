<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Proceeding;
use App\Services\Admin\AnnotationService;
use App\Services\Admin\ProceedingService;
use Illuminate\Http\Request;

class AdminAnnotationController extends Controller
{
    protected $annotationService;

    public function __construct()
    {
        $this->annotationService = new AnnotationService;
    }
    
    public function create($proceedingId)
    {
        $proceedingService = new ProceedingService;
        $proceeding = new Proceeding;
        $proceeding = $proceedingService->getProceedingById($proceedingId);
        
        return view('admin.annotations.new', compact('proceeding'));
    }

    public function store(Request $request, $proceedingId)
    {
        $this->annotationService->createNewAnnotation($request, $proceedingId);

        return redirect()->route('proceeding.show', ['proceedingId' => $proceedingId]);
    }

    public function edit($annotationId)
    {
        $annotation = $this->annotationService->getAnnotation($annotationId);

        return view('admin.annotations.edit', compact('annotation'));
    }

    public function update(Request $request, $annotationId)
    {
        $data['title']      = $request->get('titulo');
        $data['description']= $request->get('descripcion');

        $annotation = $this->annotationService->updateAnnotation($data, $annotationId);
        
        return redirect()->route('proceeding.show', ['proceedingId' => $annotation->proceeding_id]);
    }

    public function destroy($annotationId)
    {
        $annotation = $this->annotationService->deleteAnnotation($annotationId);

        return response('Anotación eliminada',200)->header('Content-Type', 'text/plain');;
    }
}
