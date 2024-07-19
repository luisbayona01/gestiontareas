<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
{
   
    public function authorize()
    {
        return true;
    }

   
    public function rules()
    {
        return [
			'user_id' => 'required',
			'title' => 'required|string',
			'description' => 'required|string',
			'status' => 'required|string',
        ];
    }
}
