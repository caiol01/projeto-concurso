<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VehicleRequest extends FormRequest
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
            'name' => 'required|string',
            'brand' => 'required',
            'vehicle_year' => 'required|integer',
            'kilometers' => 'required|integer',
            'city' => 'required',
            'type' => 'required',
            'price' => 'required|integer',
            'description' => 'nullable',
            'image' => 'nullable',
            'contact_name' => 'required|string|min:3',
            'contact_phone' => 'required|string',
            'contact_mail' => 'required|email',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'o Nome do Veículo é obrigatório',
            'name.string' => 'o Nome do Veículo precisa ser um texto',

            'brand.required' => 'a Marca do Veículo é obrigatória',

            'vehicle_year.required' => 'o Ano do Veículo é obrigatório',
            'vehicle_year.integer' => 'o Ano do Veículo precisa ser um número',

            'kilometers.required' => 'a Kilometragem é obrigatória',
            'vehicle_year.integer' => 'a Kilometragem precisa ser um número',

            'city.required' => 'a Cidade é obrigatória',

            'type.required' => 'o Tipo do Veículo é obrigatório',

            'price.required' => 'o Preço do Veículo é obrigatório',
            'price.integer' => 'o Preço do Veículo precisa ser um número',

            'description' => 'nullable',

            'image' => 'nullable',

            'contact_name.required' => 'o Nome do Vendedor é obrigatório',
            'contact_name.string' => 'o Nome do Vendedor precisa ser um texto',
            'contact_name.min' => 'o Nome do Vendedor precisa conter pelo menos 3 caracteres',
            
            'contact_phone.required' => 'o Telefone do Vendedor é obrigatório',
            'contact_phone.string' => 'o Telefone do Vendedor precisa ser um texto',

            'contact_mail.required' => 'o E-mail do Vendedor é obrigatório',
            'contact_mail.string' => 'o E-mail do Vendedor precisa ser válido',
        ];
    }
}
