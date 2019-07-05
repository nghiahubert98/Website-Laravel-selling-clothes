<?php

namespace App\Http\Requests;

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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'txtUser' => 'required|unique:users,username',
            'txtPass'   => 'required',
            'txtRePass' => 'required|same:txtPass',
            'txtFName'  => 'required',
            'txtEmail'  => 'required|regex:/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/',
            'txtAddress'    => 'required',
            'txtPhone'  => 'required|digits_between:10,11|numeric'

        ];
    }
    public function messages(){
        return [
            'txtUser.required' => 'Please Enter Username',
            'txtUser.unique'    => 'User Is Exists',
            'txtPass.required' => 'Please Enter Password',
            'txtRePass.required' => 'Please Enter RePassword',
            'txtRePass.same'    => 'Two Password Don\'t Match',
            'txtFName.required' => 'Please Enter Your Fullname',
            'txtEmail.required' =>  'Please Enter Email',
            'txtEmail.regex' => 'Email Error Syntax',
            'txtAddress.required' =>  'Please Enter Address',
            'txtPhone.required' => 'Please Enter Phone Number',
            'txtPhone.digits_between' => 'Phone Number Between 10 And 11',
            'txtPhone.numeric' => 'The Phone Must Be a Number'
        ];
    }
}
