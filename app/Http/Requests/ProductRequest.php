<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            "codigo" => "required|min:5|max:25",
            "nombre" => "required|min:5|max:50",
            "imagen" => [
                "file", 
                "required", 
                "mimes:jpg,jpeg,png", //solo acepta archivos con extensión de imagenes
                "min:1", //Mínimo un 1KB 
                "max:5120" //Máximo 5MB
            ],
            "cantidad" => "required|integer|min:1",
            "precio" => "required|numeric|min:1"
        ];
    }

    public function messages(){
        return [
            "imagen.max" => "La imagen debe tener un tamaño menor o igual a 5MB.",
            "imagen.min" => "La imagen debe tener un tamaño mayor o igual a 1KB.",
            "imagen.mimes" => "Solo se aceptan archivos con las siguientes extensiones: jpg, jpeg, png.",
            "imagen.file" => "Este campo debe ser un archivo.",
            "imagen.required" => "Este es un campo obligatorio.",
            
            "nombre.required" => "Este campo es obligatorio.",
            "nombre.min" => "El valor mínimo para este campo es 5.",
            "nombre.max" => "El valor máximo para este campo es 50.",

            "codigo.required" => "Este campo es obligatorio.",
            "codigo.min" => "El campo codigo debe tener mínimo 5 caracteres.",
            "codigo.max" => "El campo codigo debe tener máximo 25 caracteres.",
            "codigo.unique" => "Este código ya está asignado a otro producto.",

            "precio.required" => "Este campo es obligatorio.",
            "precio.min" => "El valor mínimo para este campo es 1.",
            "precio.numeric" => "El campo precio debe ser numerico.",

            "cantidad.required" => "Este campo es obligatorio.",
            "cantidad.min" => "El valor mínimo para este campo es 1.",
            "cantidad.integer" => "Este campo debe ser un número entero."

        ];
    }
}
