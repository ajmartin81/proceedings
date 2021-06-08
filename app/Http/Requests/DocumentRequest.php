<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DocumentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'titulo'    => 'required',
            'documento' => 'required|mimes:jpeg,png,jpg,pdf,doc,docx|max:5120',
        ];
    }

    public function messages()
    {
        return [
            'titulo.requires'       => 'Debes insertar un título.',
            'documento.required'    => 'Debes seleccionar un documento',
            'documento.mimes'       => 'Formato de archivo no soportado',
            'documento.max'         => 'El archivo seleccionado es demasiado grande. Máx 5Mb.'
        ];
    }
}
