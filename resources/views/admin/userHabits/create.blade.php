@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.userHabit.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.user-habits.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="user_id">{{ trans('cruds.userHabit.fields.user') }}</label>
                <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id" required>
                    @foreach($users as $id => $entry)
                        <option value="{{ $id }}" {{ old('user_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
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
                <select class="form-control select2 {{ $errors->has('habit') ? 'is-invalid' : '' }}" name="habit_id" id="habit_id" required>
                    @foreach($habits as $id => $entry)
                        <option value="{{ $id }}" {{ old('habit_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
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
                <div class="form-check {{ $errors->has('notify_by_email') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="notify_by_email" value="0">
                    <input class="form-check-input" type="checkbox" name="notify_by_email" id="notify_by_email" value="1" {{ old('notify_by_email', 0) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="notify_by_email">{{ trans('cruds.userHabit.fields.notify_by_email') }}</label>
                </div>
                @if($errors->has('notify_by_email'))
                    <div class="invalid-feedback">
                        {{ $errors->first('notify_by_email') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.userHabit.fields.notify_by_email_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('send_sms_reminder') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="send_sms_reminder" value="0">
                    <input class="form-check-input" type="checkbox" name="send_sms_reminder" id="send_sms_reminder" value="1" {{ old('send_sms_reminder', 0) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="send_sms_reminder">{{ trans('cruds.userHabit.fields.send_sms_reminder') }}</label>
                </div>
                @if($errors->has('send_sms_reminder'))
                    <div class="invalid-feedback">
                        {{ $errors->first('send_sms_reminder') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.userHabit.fields.send_sms_reminder_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('agreed_to_terms') ? 'is-invalid' : '' }}">
                    <input class="form-check-input" type="checkbox" name="agreed_to_terms" id="agreed_to_terms" value="1" required {{ old('agreed_to_terms', 0) == 1 ? 'checked' : '' }}>
                    <label class="required form-check-label" for="agreed_to_terms">{{ trans('cruds.userHabit.fields.agreed_to_terms') }}</label>
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



@endsection