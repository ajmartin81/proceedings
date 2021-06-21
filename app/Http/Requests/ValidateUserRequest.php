<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidateUserRequest extends FormRequest
{
    
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'email'                 => 'required|email|exists:users,email',
            'password'              => ['required',
                                        'min:8',
                                        'regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%&]).*$/'],
            'password_confirmation' => 'required|same:password',
            'rgpd'                  => 'required',
        ];
    }

    public function messages()
    {
        return [
            'email.required'    => 'Debe introducir un email.',
            'email.email'       => 'Debe introducir un email válido.',
            'email.exists'      => 'El email indicado no existe en nuestra base de datos.', 
            'password.required' => 'Debe introducir una contraseña.',
            'password.min'      => 'La contraseña de tener una longitud de 8 carácteres como mínimo.',
            'password.regex'    => 'La contraseña debe contener al menos 3 letras, un número y un caracter expecial !$#%&.',
            'password_confirmation.required' => 'Debe confirmar la contraseña.',
            'password_confirmation.same'    => 'Las contraseñas deben ser iguales.',
            'rgpd.required'     => 'Debe aceptar la política de protección de datos.'
        ];
    }
}
