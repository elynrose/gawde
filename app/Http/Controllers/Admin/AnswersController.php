<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyAnswerRequest;
use App\Http\Requests\StoreAnswerRequest;
use App\Http\Requests\UpdateAnswerRequest;
use App\Models\Answer;
use App\Models\Survey;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AnswersController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('answer_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $answers = Answer::with(['survey', 'user'])->get();

        return view('admin.answers.index', compact('answers'));
    }

    public function create()
    {
        abort_if(Gate::denies('answer_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $surveys = Survey::pluck('question', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::pluck('user_code', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.answers.create', compact('surveys', 'users'));
    }

    public function store(StoreAnswerRequest $request)
    {
        $answer = Answer::create($request->all());

        return redirect()->route('admin.answers.index');
    }

    public function edit(Answer $answer)
    {
        abort_if(Gate::denies('answer_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $surveys = Survey::pluck('question', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::pluck('user_code', 'id')->prepend(trans('global.pleaseSelect'), '');

        $answer->load('survey', 'user');

        return view('admin.answers.edit', compact('answer', 'surveys', 'users'));
    }

    public function update(UpdateAnswerRequest $request, Answer $answer)
    {
        $answer->update($request->all());

        return redirect()->route('admin.answers.index');
    }

    public function show(Answer $answer)
    {
        abort_if(Gate::denies('answer_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $answer->load('survey', 'user');

        return view('admin.answers.show', compact('answer'));
    }

    public function destroy(Answer $answer)
    {
        abort_if(Gate::denies('answer_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $answer->delete();

        return back();
    }

    public function massDestroy(MassDestroyAnswerRequest $request)
    {
        $answers = Answer::find(request('ids'));

        foreach ($answers as $answer) {
            $answer->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
