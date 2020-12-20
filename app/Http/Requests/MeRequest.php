<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\User;

class MeRequest extends FormRequest
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
        $existing = $this->id ? User::find($this->id) : null;
        $unique = Rule::unique('users')->ignore($existing);

        return [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'max:255', $unique],
            'username' => ['required', 'string', 'max:255', $unique],
        ];
    }

    /**
     * Get the validation messages.
     * 
     * @return array
     */
    public function messages()
    {
        return [

        ];
    }
}
