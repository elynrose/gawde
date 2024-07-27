<?php

namespace App\Http\Requests;

use App\Models\Scheduler;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroySchedulerRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('scheduler_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:schedulers,id',
        ];
    }
}
