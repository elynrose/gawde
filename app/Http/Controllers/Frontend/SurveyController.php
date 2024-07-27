<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroySurveyRequest;
use App\Http\Requests\StoreSurveyRequest;
use App\Http\Requests\UpdateSurveyRequest;
use App\Models\Habit;
use App\Models\Survey;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SurveyController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('survey_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $surveys = Survey::with(['habit'])->get();

        return view('frontend.surveys.index', compact('surveys'));
    }

    public function create()
    {
        abort_if(Gate::denies('survey_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $habits = Habit::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.surveys.create', compact('habits'));
    }

    public function store(StoreSurveyRequest $request)
    {
        $survey = Survey::create($request->all());

        return redirect()->route('frontend.surveys.index');
    }

    public function edit(Survey $survey)
    {
        abort_if(Gate::denies('survey_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $habits = Habit::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $survey->load('habit');

        return view('frontend.surveys.edit', compact('habits', 'survey'));
    }

    public function update(UpdateSurveyRequest $request, Survey $survey)
    {
        $survey->update($request->all());

        return redirect()->route('frontend.surveys.index');
    }

    public function show(Survey $survey)
    {
        abort_if(Gate::denies('survey_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $survey->load('habit');

        return view('frontend.surveys.show', compact('survey'));
    }

    public function destroy(Survey $survey)
    {
        abort_if(Gate::denies('survey_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $survey->delete();

        return back();
    }

    public function massDestroy(MassDestroySurveyRequest $request)
    {
        $surveys = Survey::find(request('ids'));

        foreach ($surveys as $survey) {
            $survey->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
