<?php

namespace App\Http\Requests;

use App\Models\Survey;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreSurveyRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('survey_create');
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
