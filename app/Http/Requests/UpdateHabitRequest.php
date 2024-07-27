<?php

namespace App\Http\Requests;

use App\Models\Habit;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateHabitRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('habit_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'active' => [
                'required',
            ],
        ];
    }
}
