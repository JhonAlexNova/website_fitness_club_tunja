<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\UserMembresia;
use Carbon\Carbon;

class UpdateUserMembresiaRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = UserMembresia::$rules;

        if (is_string($rules['fecha_vencimiento'])) {
            $rules['fecha_vencimiento'] = explode('|', $rules['fecha_vencimiento']);
        }

        $rules['fecha_vencimiento'][] = function ($attribute, $value, $fail) {
            if ($this->input('estado') === 'activa' && Carbon::parse($value)->lt(Carbon::today())) {
                $fail('No puedes activar una membresía con fecha de vencimiento en el pasado. Primero actualiza la Fecha de Vencimiento a una fecha futura.');
            }
        };

        return $rules;
    }

    public function messages()
    {
        return [
            'fecha_vencimiento.required' => 'La fecha de vencimiento es obligatoria.',
            'fecha_inicio.required'      => 'La fecha de inicio es obligatoria.',
        ];
    }
}
