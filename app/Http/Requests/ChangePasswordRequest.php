<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
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
          'passwordold' => 'current_password',
          'password' => 'required|min:6|confirmed',
      ];
    }

    public function messages()
       {
           return [
             'passwordold.current_password' => 'La contraseña actual no coincide con nuestros registros',
             'password.required' => 'La nueva contraseña es requerida',
             'password.min:6' => 'La nueva contraseña requiere al menos 6 caracteres',
             'password.confirmed' => 'El doble ingreso de la nueva contraseña no coincide',
           ];
       }

     /**
      * Get the sanitized input for the request.
      *
      * @return array
      */
     public function sanitize()
     {
         return $this->only('clave');
     }
}
