<?php

namespace App\Http\Requests\LUP;

use App\Models\LUP\LUPParent;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCategorizationRequest extends FormRequest
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
            'categorization' => 'required',             
        ];
    }
    
    public function attributes()
    {
        return [
            'categorization' => 'Categorization',         
                           
        ];
    }    
}
