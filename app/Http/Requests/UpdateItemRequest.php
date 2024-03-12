<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateItemRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title_ua' => 'required',
            'title_ru' => 'required',
            'price' => 'required',
            'photo' => 'nullable|image'
        ];
    }
}
