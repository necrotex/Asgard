<?php

namespace Asgard\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewApplicationFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; //todo: permissions and stuff
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'description' => 'required',
            'corporation_id' => 'required|numeric'
        ];
    }
}
