<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VentaFormRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'id_cliente_oculto' => 'max:2000',
            'id_proveedor' => 'max:2000',
            'productos' => 'max:2000',
            'nombre_producto' => 'max:2000',
            'cantidad_producto' => 'max:2000',
            'precio_producto' => 'max:2000',

        ];
    }
}
