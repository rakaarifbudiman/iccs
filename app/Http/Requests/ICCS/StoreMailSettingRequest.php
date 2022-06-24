<?php

namespace App\Http\Requests\ICCS;

use Illuminate\Foundation\Http\FormRequest;

class StoreMailSettingRequest extends FormRequest
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
           'driver'=>'required|max:10',            
           'host'=>'required|regex:/^[AZa-z\.]',
           'port'=>'required|numeric',           
           'username'=>'required|string|email|max:255|regex:/^[AZa-z\.]*@(sohoglobalhealth)[.](com)$/',
           'password'=>'required',           
           'from_address'=>'required|email|max:255|regex:/^[AZa-z\.]*@(sohoglobalhealth)[.](com)$/',
           'from_name'=>'required',
        ];
    }
}
