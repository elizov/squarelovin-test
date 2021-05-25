<?php

namespace App\Http\Requests\Import;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        $rules = [];

        foreach (request()->import->mapping as $item) {
            $rules[$item] = [
                'sometimes',
                'regex:/^[_a-z]+$/',
                'max:50',
            ];
        }

        return $rules;
    }
}
