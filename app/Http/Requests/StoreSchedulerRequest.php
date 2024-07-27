<?php

namespace App\Http\Requests;

use App\Models\Scheduler;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreSchedulerRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('scheduler_create');
    }

    public function rules()
    {
        return [
            'habit_id' => [
                'required',
                'integer',
            ],
            'today' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'user_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
