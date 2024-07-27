@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.show') }} {{ trans('cruds.userHabit.title') }}
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.user-habits.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.userHabit.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $userHabit->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.userHabit.fields.user') }}
                                    </th>
                                    <td>
                                        {{ $userHabit->user->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.userHabit.fields.habit') }}
                                    </th>
                                    <td>
                                        {{ $userHabit->habit->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.userHabit.fields.notify_by_email') }}
                                    </th>
                                    <td>
                                        <input type="checkbox" disabled="disabled" {{ $userHabit->notify_by_email ? 'checked' : '' }}>
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.userHabit.fields.send_sms_reminder') }}
                                    </th>
                                    <td>
                                        <input type="checkbox" disabled="disabled" {{ $userHabit->send_sms_reminder ? 'checked' : '' }}>
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.userHabit.fields.agreed_to_terms') }}
                                    </th>
                                    <td>
                                        <input type="checkbox" disabled="disabled" {{ $userHabit->agreed_to_terms ? 'checked' : '' }}>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.user-habits.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection