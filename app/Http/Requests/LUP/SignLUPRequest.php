<?php

namespace App\Http\Requests\LUP;

use App\Models\User;
use App\Models\LUP\LUPParent;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Auth\Access\Response;
use Illuminate\Foundation\Http\FormRequest;

class SignLUPRequest extends FormRequest
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
        $listleaders = DB::table('users')->where([['active',1]])->where('grade_level','>',1)->get('username');      
        $listregulatory_reviewers = DB::table('approvals')->where([['active',1]])->where('type','Reviewer Regulatory')->get('username');       
        $listregulatory_approvers = DB::table('approvals')->where([['active',1]])->where('type','approval Regulatory')->get('username');     
        /* @dd($listregulatory_approvers->implode('username',',')); */
        return [
            'leader'=>'in:'.$listleaders->implode('username',','),      
            'regulatory_reviewer'=>'in:'.$listregulatory_reviewers->implode('username',','),   
            'regulatory_approver'=>'in:'.$listregulatory_approvers->implode('username',','),      
        ];
    }
    public function messages()
    {
        return [
           
        ];
    }
    public function attributes()
    {
        return [
            'leader'=>'Leader'
                           
        ];
    }

    
}
