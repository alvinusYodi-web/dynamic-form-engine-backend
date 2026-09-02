<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFormRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'answers' => ['required', 'array', 'min:1'],

            'answers.*.payload_id' => [
                'required',
                'string',
                'exists:payloads,id',
            ],

            'answers.*.value' => [
                'nullable',
                'string',
            ],

            'answers.*.option_ids' => [
                'nullable',
                'array',
            ],

            'answers.*.option_ids.*' => [
                'string',
                'distinct',
                'exists:options,id',
            ],
        ];
    }
}