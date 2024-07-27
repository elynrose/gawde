@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.answer.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.answers.update", [$answer->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="survey_id">{{ trans('cruds.answer.fields.survey') }}</label>
                            <select class="form-control select2" name="survey_id" id="survey_id" required>
                                @foreach($surveys as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('survey_id') ? old('survey_id') : $answer->survey->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
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
                            <input class="form-control" type="text" name="answer" id="answer" value="{{ old('answer', $answer->answer) }}">
                            @if($errors->has('answer'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('answer') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.answer.fields.answer_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="score">{{ trans('cruds.answer.fields.score') }}</label>
                            <input class="form-control" type="number" name="score" id="score" value="{{ old('score', $answer->score) }}" step="1">
                            @if($errors->has('score'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('score') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.answer.fields.score_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="user_id">{{ trans('cruds.answer.fields.user') }}</label>
                            <select class="form-control select2" name="user_id" id="user_id" required>
                                @foreach($users as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('user_id') ? old('user_id') : $answer->user->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
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
                            <input class="form-control date" type="text" name="submitted_at" id="submitted_at" value="{{ old('submitted_at', $answer->submitted_at) }}" required>
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

        </div>
    </div>
</div>
@endsection