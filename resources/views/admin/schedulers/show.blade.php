@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.scheduler.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.schedulers.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.scheduler.fields.id') }}
                        </th>
                        <td>
                            {{ $scheduler->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.scheduler.fields.habit') }}
                        </th>
                        <td>
                            {{ $scheduler->habit->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.scheduler.fields.today') }}
                        </th>
                        <td>
                            {{ $scheduler->today }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.scheduler.fields.user') }}
                        </th>
                        <td>
                            {{ $scheduler->user->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.scheduler.fields.reminded') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $scheduler->reminded ? 'checked' : '' }}>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.schedulers.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection