<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateActivityRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'client_id' => 'required',
            'activity' => ['required'],
            'start_date' => ['required'],
            'end_date' => ['required'],
            'start_time' => 'required',
            'repeat' => 'required',
            'days' => 'required'
        ];
    }
}
