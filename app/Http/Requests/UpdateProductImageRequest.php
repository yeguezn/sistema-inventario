<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductImageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "imagen" => [
                "file", 
                "required", 
                "mimes:jpg,jpeg,png", //solo acepta archivos con extensión de imagenes
                "min:1", //Mínimo un 1KB 
                "max:5120" //Máximo 5MB
            ]
        ];
    }

    public function messages(){
        return [
            "imagen.max" => "La imagen debe tener un tamaño menor o igual a 5MB.",
            "imagen.min" => "La imagen debe tener un tamaño mayor o igual a 1KB.",
            "imagen.mimes" => "Solo se aceptan archivos con las siguientes extensiones: jpg, jpeg, png.",
            "imagen.file" => "Este campo debe ser un archivo.",
            "imagen.required" => "Este es un campo obligatorio."
        ];
    }
}
