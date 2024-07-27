@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.scheduler.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.schedulers.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="habit_id">{{ trans('cruds.scheduler.fields.habit') }}</label>
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
                <span class="help-block">{{ trans('cruds.scheduler.fields.habit_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="today">{{ trans('cruds.scheduler.fields.today') }}</label>
                <input class="form-control date {{ $errors->has('today') ? 'is-invalid' : '' }}" type="text" name="today" id="today" value="{{ old('today') }}" required>
                @if($errors->has('today'))
                    <div class="invalid-feedback">
                        {{ $errors->first('today') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.scheduler.fields.today_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="user_id">{{ trans('cruds.scheduler.fields.user') }}</label>
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
                <span class="help-block">{{ trans('cruds.scheduler.fields.user_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('reminded') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="reminded" value="0">
                    <input class="form-check-input" type="checkbox" name="reminded" id="reminded" value="1" {{ old('reminded', 0) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="reminded">{{ trans('cruds.scheduler.fields.reminded') }}</label>
                </div>
                @if($errors->has('reminded'))
                    <div class="invalid-feedback">
                        {{ $errors->first('reminded') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.scheduler.fields.reminded_helper') }}</span>
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