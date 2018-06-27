<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LinkRequest extends FormRequest
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
                    'title'=>'required',
                    'url'=>'required',
                    'orders'=>'required',
                    'status'=>'required',
                ];
                break;
            case 'PUT':
                return [
                    'name'=>'required',
                    'title'=>'required',
                    'url'=>'required',
                    'orders'=>'required',
                    'status'=>'required',
                ];
            case 'PATCH':
            default:break;
        }

    }

    public function messages()
    {
        return [
            'name.required'=>'请输入推荐链接名称',
            'title.required'=>'请输入推荐链接标题',
            'url.required'=>'请输入推荐链接url',
            'orders.required'=>'请输入推荐链接排序号',
            'status.required'=>'请输入推荐链接状态',
        ];
    }
}
