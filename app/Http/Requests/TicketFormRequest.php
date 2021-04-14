<?php

namespace App\Http\Requests;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

use Illuminate\Foundation\Http\FormRequest;

class TicketFormRequest extends FormRequest
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
            'subject' => ['required'],
            'priority_id' => ['required'],
            'status_id' => ['required'],
            'user_id' => ['required'],
        ];

        return $rules;
    }
}
