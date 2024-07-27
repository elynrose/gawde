@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.userHabit.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.user-habits.update", [$userHabit->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="user_id">{{ trans('cruds.userHabit.fields.user') }}</label>
                            <select class="form-control select2" name="user_id" id="user_id" required>
                                @foreach($users as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('user_id') ? old('user_id') : $userHabit->user->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('user'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('user') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.userHabit.fields.user_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="habit_id">{{ trans('cruds.userHabit.fields.habit') }}</label>
                            <select class="form-control select2" name="habit_id" id="habit_id" required>
                                @foreach($habits as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('habit_id') ? old('habit_id') : $userHabit->habit->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('habit'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('habit') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.userHabit.fields.habit_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <div>
                                <input type="hidden" name="notify_by_email" value="0">
                                <input type="checkbox" name="notify_by_email" id="notify_by_email" value="1" {{ $userHabit->notify_by_email || old('notify_by_email', 0) === 1 ? 'checked' : '' }}>
                                <label for="notify_by_email">{{ trans('cruds.userHabit.fields.notify_by_email') }}</label>
                            </div>
                            @if($errors->has('notify_by_email'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('notify_by_email') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.userHabit.fields.notify_by_email_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <div>
                                <input type="hidden" name="send_sms_reminder" value="0">
                                <input type="checkbox" name="send_sms_reminder" id="send_sms_reminder" value="1" {{ $userHabit->send_sms_reminder || old('send_sms_reminder', 0) === 1 ? 'checked' : '' }}>
                                <label for="send_sms_reminder">{{ trans('cruds.userHabit.fields.send_sms_reminder') }}</label>
                            </div>
                            @if($errors->has('send_sms_reminder'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('send_sms_reminder') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.userHabit.fields.send_sms_reminder_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <div>
                                <input type="checkbox" name="agreed_to_terms" id="agreed_to_terms" value="1" {{ $userHabit->agreed_to_terms || old('agreed_to_terms', 0) === 1 ? 'checked' : '' }} required>
                                <label class="required" for="agreed_to_terms">{{ trans('cruds.userHabit.fields.agreed_to_terms') }}</label>
                            </div>
                            @if($errors->has('agreed_to_terms'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('agreed_to_terms') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.userHabit.fields.agreed_to_terms_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-danger" type="submit">
                                {{ trans('global.save') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection