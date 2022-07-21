<?php

namespace App\Http\Requests\FLP;

use App\Models\LUP\LUPParent;
use Illuminate\Foundation\Http\FormRequest;

class StoreFLPRequest extends FormRequest
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
            'documentname' => 'required|min:5',
            'ingredients' => 'required|min:5',
            'dosageform' => 'required|min:2',            
            'packaging' => 'required|min:2',
            'bussinessunit' => 'required',
            'regno' => 'required|min:2',
            'het' => 'required|min:2',
            'duedate_start' => 'required|after:tomorrow'
        ];
    }

    public function attributes()
    {
        return [
            'documentname' => 'Title',
            'ingredients' => 'Ingredients',
            'dosageform' => 'Dosage Form',            
            'packaging' => 'Packaging',
            'regno' => 'Reg No',
            'het' => 'HET',
            'duedate_start' => 'Launch Date'
        ];
    }
}
