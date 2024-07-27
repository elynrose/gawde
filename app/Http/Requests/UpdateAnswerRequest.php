<?php

namespace App\Http\Requests;

use App\Models\Answer;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateAnswerRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('answer_edit');
    }

    public function rules()
    {
        return [
            'survey_id' => [
                'required',
                'integer',
            ],
            'answer' => [
                'string',
                'nullable',
            ],
            'score' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'user_id' => [
                'required',
                'integer',
            ],
            'submitted_at' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
        ];
    }
}
