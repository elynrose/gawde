<?php

namespace App\Http\Requests;

use App\Models\Survey;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateSurveyRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('survey_edit');
    }

    public function rules()
    {
        return [
            'habit_id' => [
                'required',
                'integer',
            ],
            'question' => [
                'string',
                'required',
            ],
        ];
    }
}
