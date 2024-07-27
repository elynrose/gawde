<?php

namespace App\Http\Requests;

use App\Models\Agent;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateAgentRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('agent_edit');
    }

    public function rules()
    {
        return [
            'date_reviewed' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'habit_id' => [
                'required',
                'integer',
            ],
            'user_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
