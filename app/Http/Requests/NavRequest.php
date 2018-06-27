<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NavRequest extends FormRequest
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
                    'name'=>'required',
                    'alias'=>'required',
                    'url' => 'required',
                    'orders' => 'required',
                ];
                break;
            case 'PUT':
                return [
                    'name'=>'required',
                    'alias'=>'required',
                    'url'=>'required',
                    'orders'=>'required',
                ];
            case 'PATCH':
            default:break;
        }

    }

    public function messages()
    {
        return [
            'name.required'=>'请输入导航栏名称',
            'alias.required'=>'请输入导航栏别名',
            'url.required'=>'请输入导航栏url',
            'orders.required'=>'请输入排序',
        ];
    }
}
