<?php

namespace App\Http\Requests\LUP;

use App\Models\LUP\LUPParent;
use Illuminate\Foundation\Http\FormRequest;

class StoreLUPParentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $lup = LUPParent::find($this->route('id'));

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
            'documentname' => 'required',
            'lup_type' => 'required',
            'lup_type_others' =>'required_if:lup_type,Others',
            'duedate_type' =>'required',
            'duedate_start' =>'required|after:tomorrow',
            'duedate_finish' => 'exclude_if:duedate_type,Permanent|required_if:duedate_type,Temporary|prohibitedIf:duedate_type,Permanent|after:duedate_start',
            'lup_current' =>'required|min:10',
            'lup_proposed' =>'required|min:10',
            'lup_reason' =>'required|min:10',     
        ];
    }
    public function messages()
    {
        return [
            'lup_type_others.required_if' => 'Field is required when Change Related to filled with Others',
            'duedate_start.after' =>'Date cannot be backdate',    
            'duedate_finish.required_if' =>'Date must be filled when choose Temporary',       
            'duedate_finish.after' =>'Date must be after Due Date Start',    
            'lup_type.required'   => 'Change Related to must be select at least one'
        ];
    }
    public function attributes()
    {
        return [
            'documentname' => 'Title',
            'lup_type' => 'Change Related To',
            'lup_type_others' => 'Change Related To (if Others)',
            'duedate_type' =>'Change Type',   
            'duedate_start' =>'Due Date Implementation',    
            'duedate_finish' =>'Due Date Finish (Temporary)',    
            'lup_current' =>'Current Condition',
            'lup_proposed' =>'Proposed Change',
            'lup_reason' =>'Change Reason',  
              
        ];
    }
}
