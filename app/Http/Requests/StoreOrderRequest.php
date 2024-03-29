<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
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
            "client_name" => ["required", "min:2", "max:50"],
            "client_surname" => ["required", "min:2", "max:50"],
            "client_mail" => ["required", "min:10", "max:100"],
            "client_phone" => ["required", "min:9", "max:164"],
            "client_address" => ["required", "min:10"],
            "total" => ["required"],
        ];
    }
}
