@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.survey.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.surveys.update", [$survey->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="habit_id">{{ trans('cruds.survey.fields.habit') }}</label>
                <select class="form-control select2 {{ $errors->has('habit') ? 'is-invalid' : '' }}" name="habit_id" id="habit_id" required>
                    @foreach($habits as $id => $entry)
                        <option value="{{ $id }}" {{ (old('habit_id') ? old('habit_id') : $survey->habit->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('habit'))
                    <div class="invalid-feedback">
                        {{ $errors->first('habit') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.survey.fields.habit_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="question">{{ trans('cruds.survey.fields.question') }}</label>
                <input class="form-control {{ $errors->has('question') ? 'is-invalid' : '' }}" type="text" name="question" id="question" value="{{ old('question', $survey->question) }}" required>
                @if($errors->has('question'))
                    <div class="invalid-feedback">
                        {{ $errors->first('question') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.survey.fields.question_helper') }}</span>
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