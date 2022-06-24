<?php

namespace App\Http\Requests\LUP;

use App\Models\LUP\LUPParent;
use Illuminate\Foundation\Http\FormRequest;

class UpdateLUPParentRequest extends FormRequest
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
            'risk_assestment' => 'required|min:10',             
        ];
    }
    public function messages()
    {
        return [
            'lup_type_others.required_if' => 'Field is required when Change Related to filled with Others',
            'duedate_start.after' =>'Date cannot be backdate',    
            'duedate_finish.required_if' =>'Date must be filled when choose Temporary',       
            'duedate_finish.after' =>'Date must be after Due Date Start',       
            'lup_type.required'   => 'Change Related to must be select at least one',
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
            'risk_assestment' => 'Risk Assestment',       
                           
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([            
                'product_impact'=>(bool) $this->product_impact,
                'facilities_impact'=>(bool) $this->facilities_impact,
                'equipment_impact'=>(bool) $this->equipment_impact,
                'decomission_impact'=>(bool) $this->decomission_impact,
                'productcontact_impact'=>(bool) $this->productcontact_impact,
                'maintenance_impact'=>(bool) $this->maintenance_impact,
                'compliance_impact'=>(bool) $this->compliance_impact,
                'regulatory_impact'=>(bool) $this->regulatory_impact,
                'patient_impact'=>(bool) $this->patient_impact,
                'integrity_impact'=>(bool) $this->integrity_impact,
                'environment_impact'=>(bool) $this->environment_impact,
                'health_impact'=>(bool) $this->health_impact,
                'computer_impact'=>(bool) $this->computer_impact,
                'supply_impact'=>(bool) $this->supply_impact,
                'validation_impact'=>(bool) $this->validation_impact,
                'stability_impact'=>(bool) $this->stability_impact,
        ]);
    }
}
