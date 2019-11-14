<?php

namespace App\Modules\LeadComment\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LeadCommentsRequest extends FormRequest
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
        return [
            'leadId'=>'required|integer',
            'status_id'=>'required|string',
            'text'=>'string|nullable'
        ];
    }
}
