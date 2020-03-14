<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskStoreRequest extends FormRequest
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
            'task_title' => 'bail | required | string | max:100 | unique:tasks',
        ];
    }

    public function messages()
    {
        return [
            'task_title.required' => 'Task title can not be empty',
            'task_title.string' => 'Task title must be string',
            'task_title.max' => 'Task title can not be more than 100 character ',
        ];
    }
}
