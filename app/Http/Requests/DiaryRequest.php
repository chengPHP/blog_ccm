<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DiaryRequest extends FormRequest
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
                    'art'=>'required',
                    'status'=>'required',
                ];
                break;
            case 'PUT':
                return [
                    'art'=>'required',
                    'status'=>'required',
                ];
            case 'PATCH':
            default:break;
        }

    }

    public function messages()
    {
        return [
            'art.required'=>'请输入日记内容',
            'status.required'=>'请选择日记状态',
        ];
    }
}
