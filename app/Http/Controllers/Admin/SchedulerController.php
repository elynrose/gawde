<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroySchedulerRequest;
use App\Http\Requests\StoreSchedulerRequest;
use App\Http\Requests\UpdateSchedulerRequest;
use App\Models\Habit;
use App\Models\Scheduler;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SchedulerController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('scheduler_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $schedulers = Scheduler::with(['habit', 'user'])->get();

        return view('admin.schedulers.index', compact('schedulers'));
    }

    public function create()
    {
        abort_if(Gate::denies('scheduler_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $habits = Habit::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.schedulers.create', compact('habits', 'users'));
    }

    public function store(StoreSchedulerRequest $request)
    {
        $scheduler = Scheduler::create($request->all());

        return redirect()->route('admin.schedulers.index');
    }

    public function edit(Scheduler $scheduler)
    {
        abort_if(Gate::denies('scheduler_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $habits = Habit::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $scheduler->load('habit', 'user');

        return view('admin.schedulers.edit', compact('habits', 'scheduler', 'users'));
    }

    public function update(UpdateSchedulerRequest $request, Scheduler $scheduler)
    {
        $scheduler->update($request->all());

        return redirect()->route('admin.schedulers.index');
    }

    public function show(Scheduler $scheduler)
    {
        abort_if(Gate::denies('scheduler_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $scheduler->load('habit', 'user');

        return view('admin.schedulers.show', compact('scheduler'));
    }

    public function destroy(Scheduler $scheduler)
    {
        abort_if(Gate::denies('scheduler_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $scheduler->delete();

        return back();
    }

    public function massDestroy(MassDestroySchedulerRequest $request)
    {
        $schedulers = Scheduler::find(request('ids'));

        foreach ($schedulers as $scheduler) {
            $scheduler->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
