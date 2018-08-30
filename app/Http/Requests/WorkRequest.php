<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WorkRequest extends FormRequest
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
                    'contents'=>'required',
                    'plan_start_time'=>'required',
                    'plan_end_time'=>'required',
                ];
                break;
            case 'PUT':
                return [
                    'contents'=>'required',
                    'plan_start_time'=>'required',
                    'plan_end_time'=>'required',
                ];
            case 'PATCH':
            default:break;
        }

    }

    public function messages()
    {
        return [
            'contents.required'=>'请输入工作计划名称',
            'plan_start_time.required'=>'请选择工作计划开始时间',
            'plan_end_time.required'=>'请选择工作计划结束时间',
        ];
    }
}
