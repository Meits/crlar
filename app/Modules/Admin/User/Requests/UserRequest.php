<?php

namespace App\Modules\Admin\User\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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

    protected function getValidatorInstance()
    {

        $validator = parent::getValidatorInstance();

        $validator->sometimes('password', ['required','confirmed'], function($input)
        {
            if(!empty($input->password) || ((empty($input->password) && ($this->route()->getName() !== 'users.update' &&  $this->route()->getName() !== 'profile.update')))) {
                return TRUE;
            }

            return FALSE;
        });



        return $validator;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'role_id' => 'required',
            'status' => 'required'
        ];
    }
}
