<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Annotation;
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

    public function index()
    {
        //
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

        return redirect()->route('proceedings');
    }

    public function show(Annotation $annotation)
    {
        //
    }

    public function edit(Annotation $annotation)
    {
        //
    }

    public function update(Request $request, Annotation $annotation)
    {
        //
    }

    public function destroy(Annotation $annotation)
    {
        //
    }
}
