<?php

namespace App\Http\Requests;

use App\Models\UserHabit;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreUserHabitRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('user_habit_create');
    }

    public function rules()
    {
        return [
            'user_id' => [
                'required',
                'integer',
            ],
            'habit_id' => [
                'required',
                'integer',
            ],
            'agreed_to_terms' => [
                'required',
            ],
        ];
    }
}
