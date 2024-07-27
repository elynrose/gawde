@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.agent.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.agents.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="habit_id">{{ trans('cruds.agent.fields.habit') }}</label>
                            <select class="form-control select2" name="habit_id" id="habit_id" required>
                                @foreach($habits as $id => $entry)
                                    <option value="{{ $id }}" {{ old('habit_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('habit'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('habit') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.agent.fields.habit_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="review_results">{{ trans('cruds.agent.fields.review_results') }}</label>
                            <textarea class="form-control" name="review_results" id="review_results">{{ old('review_results') }}</textarea>
                            @if($errors->has('review_results'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('review_results') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.agent.fields.review_results_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="date_reviewed">{{ trans('cruds.agent.fields.date_reviewed') }}</label>
                            <input class="form-control date" type="text" name="date_reviewed" id="date_reviewed" value="{{ old('date_reviewed') }}">
                            @if($errors->has('date_reviewed'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('date_reviewed') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.agent.fields.date_reviewed_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="user_id">{{ trans('cruds.agent.fields.user') }}</label>
                            <select class="form-control select2" name="user_id" id="user_id" required>
                                @foreach($users as $id => $entry)
                                    <option value="{{ $id }}" {{ old('user_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('user'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('user') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.agent.fields.user_helper') }}</span>
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