<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class UserFormRequest extends FormRequest
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
    public function rules(Request $request)
    {
        $rule = [];
        $id  = $this->get('id');

        $rules = [
            'email' => [
                'required',
                Rule::unique('users', 'email')
            ],
            'name' => ['required'],
            'password' => ['required'],
            'cpwd' => ['required'],
        ];

        if ($request->method() == 'PUT') {
            $rules['email'] = [
                'required',
                Rule::unique('users', 'email')->ignore($id)
            ];
        }

        return $rules;
    }
}
