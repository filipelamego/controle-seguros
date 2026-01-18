<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDetentoRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'nome' => 'required|string|max:255',
            'matricula' => 'required|unique:detentos,matricula',
            'data_inclusao' => 'required|date',
            'tipo_inclusao_id' => 'required|exists:tipo_inclusao,id',
        ];
    }
}
