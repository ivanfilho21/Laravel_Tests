<?php

namespace stock\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // Should check user privileges first
        $authorized = true;
        return $authorized;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return array(
            "name" => "required | max:100",
            "description" => "required | max:255",
            "price" => "required | numeric"
        );
    }

    public function messages()
    {
        return array(
            "required" => "O campo :attribute não pode ficar em branco.",
            "name.required" => "Digite o nome do produto.",
            "description.required" => "Digite um descrição para o produto.",
            "price.required" => "O valor do produto é obrigatório."
        );
    }
}
