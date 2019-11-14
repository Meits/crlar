<?php

namespace App\Modules\Admin\Lead\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLead extends FormRequest
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
            'link'=>'required_without:linkPhone.phone',
            'phone'=>'required_without:linkPhone.link',
            'source_id'=>'required|integer',
            'unit_id'=>'required|integer',
            'is_processed'=>'required|string',
            'text'=>'string|nullable',
        ];
    }
}
