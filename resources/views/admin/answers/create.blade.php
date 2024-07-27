@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.answer.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.answers.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="survey_id">{{ trans('cruds.answer.fields.survey') }}</label>
                <select class="form-control select2 {{ $errors->has('survey') ? 'is-invalid' : '' }}" name="survey_id" id="survey_id" required>
                    @foreach($surveys as $id => $entry)
                        <option value="{{ $id }}" {{ old('survey_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('survey'))
                    <div class="invalid-feedback">
                        {{ $errors->first('survey') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.answer.fields.survey_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="answer">{{ trans('cruds.answer.fields.answer') }}</label>
                <input class="form-control {{ $errors->has('answer') ? 'is-invalid' : '' }}" type="text" name="answer" id="answer" value="{{ old('answer', '') }}">
                @if($errors->has('answer'))
                    <div class="invalid-feedback">
                        {{ $errors->first('answer') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.answer.fields.answer_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="score">{{ trans('cruds.answer.fields.score') }}</label>
                <input class="form-control {{ $errors->has('score') ? 'is-invalid' : '' }}" type="number" name="score" id="score" value="{{ old('score', '') }}" step="1">
                @if($errors->has('score'))
                    <div class="invalid-feedback">
                        {{ $errors->first('score') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.answer.fields.score_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="user_id">{{ trans('cruds.answer.fields.user') }}</label>
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
                <span class="help-block">{{ trans('cruds.answer.fields.user_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="submitted_at">{{ trans('cruds.answer.fields.submitted_at') }}</label>
                <input class="form-control date {{ $errors->has('submitted_at') ? 'is-invalid' : '' }}" type="text" name="submitted_at" id="submitted_at" value="{{ old('submitted_at') }}" required>
                @if($errors->has('submitted_at'))
                    <div class="invalid-feedback">
                        {{ $errors->first('submitted_at') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.answer.fields.submitted_at_helper') }}</span>
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