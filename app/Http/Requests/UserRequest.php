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
        switch ($this->method()){
            case 'GET':
                break;
            case 'DELETE':
            {
                return [];
            }
                break;
            case 'POST':
                return [
                    'name'=>'required|max:255',
                    'email'=>'required|email',
                    'password' => 'required|min:6|max:18',
                    'repassword' => 'same:password',
                ];
                break;
            case 'PUT':
                return [
                    'name'=>'required|max:255',
                    'email'=>'required|email',
                    'password' => 'nullable|min:6|max:18',
                    'repassword' => 'nullable|same:password',
                ];
            case 'PATCH':
            default:break;
        }

    }

    public function messages()
    {
        return [
            'name.required'=>'请输入用户姓名',
            'name.max'=>'用户姓名最大长度不能超过255',
            'email.required'=>'请输入邮箱',
            'password.required'=>'请输入密码',
            'password.min'=>'密码长度至少六位',
            'password.max'=>'密码长度不能超过十八位',
            'repassword.same'=>'密码不一致',
        ];
    }


}
