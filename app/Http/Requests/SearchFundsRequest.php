<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SearchFundsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'       => 'nullable|string',
            'company'    => 'nullable|string',
            'start_year' => 'nullable|integer'
        ];
    }
}
