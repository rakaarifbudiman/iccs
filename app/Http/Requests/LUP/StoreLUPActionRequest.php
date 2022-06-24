<?php

namespace App\Http\Requests\LUP;

use Illuminate\Foundation\Http\FormRequest;

class StoreLUPActionRequest extends FormRequest
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
            'duedate_action' => ['required','after:tomorrow'],
            'pic_action' => ['required','exists:users,username,active,1'],
            'action' => ['required'],  
        ];
    }

    public function attributes()
    {
        return [
            'duedate_action' => 'Due Date Action',
            'pic_action' => 'PIC Action',
            'action' => 'Action Plan',              
        ];
    }
}
