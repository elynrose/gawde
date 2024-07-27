<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyUserHabitRequest;
use App\Http\Requests\StoreUserHabitRequest;
use App\Http\Requests\UpdateUserHabitRequest;
use App\Models\Habit;
use App\Models\User;
use App\Models\UserHabit;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserHabitsController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('user_habit_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $userHabits = UserHabit::with(['user', 'habit'])->get();

        return view('frontend.userHabits.index', compact('userHabits'));
    }

    public function create()
    {
        abort_if(Gate::denies('user_habit_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $habits = Habit::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.userHabits.create', compact('habits', 'users'));
    }

    public function store(StoreUserHabitRequest $request)
    {
        $userHabit = UserHabit::create($request->all());

        return redirect()->route('frontend.user-habits.index');
    }

    public function edit(UserHabit $userHabit)
    {
        abort_if(Gate::denies('user_habit_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $habits = Habit::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $userHabit->load('user', 'habit');

        return view('frontend.userHabits.edit', compact('habits', 'userHabit', 'users'));
    }

    public function update(UpdateUserHabitRequest $request, UserHabit $userHabit)
    {
        $userHabit->update($request->all());

        return redirect()->route('frontend.user-habits.index');
    }

    public function show(UserHabit $userHabit)
    {
        abort_if(Gate::denies('user_habit_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $userHabit->load('user', 'habit');

        return view('frontend.userHabits.show', compact('userHabit'));
    }

    public function destroy(UserHabit $userHabit)
    {
        abort_if(Gate::denies('user_habit_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $userHabit->delete();

        return back();
    }

    public function massDestroy(MassDestroyUserHabitRequest $request)
    {
        $userHabits = UserHabit::find(request('ids'));

        foreach ($userHabits as $userHabit) {
            $userHabit->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
