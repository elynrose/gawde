<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyHabitRequest;
use App\Http\Requests\StoreHabitRequest;
use App\Http\Requests\UpdateHabitRequest;
use App\Models\Habit;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class HabitsController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('habit_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $habits = Habit::with(['media'])->get();

        return view('frontend.habits.index', compact('habits'));
    }

    public function create()
    {
        abort_if(Gate::denies('habit_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.habits.create');
    }

    public function store(StoreHabitRequest $request)
    {
        $habit = Habit::create($request->all());

        if ($request->input('photo', false)) {
            $habit->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $habit->id]);
        }

        return redirect()->route('frontend.habits.index');
    }

    public function edit(Habit $habit)
    {
        abort_if(Gate::denies('habit_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.habits.edit', compact('habit'));
    }

    public function update(UpdateHabitRequest $request, Habit $habit)
    {
        $habit->update($request->all());

        if ($request->input('photo', false)) {
            if (! $habit->photo || $request->input('photo') !== $habit->photo->file_name) {
                if ($habit->photo) {
                    $habit->photo->delete();
                }
                $habit->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
            }
        } elseif ($habit->photo) {
            $habit->photo->delete();
        }

        return redirect()->route('frontend.habits.index');
    }

    public function show(Habit $habit)
    {
        abort_if(Gate::denies('habit_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.habits.show', compact('habit'));
    }

    public function destroy(Habit $habit)
    {
        abort_if(Gate::denies('habit_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $habit->delete();

        return back();
    }

    public function massDestroy(MassDestroyHabitRequest $request)
    {
        $habits = Habit::find(request('ids'));

        foreach ($habits as $habit) {
            $habit->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('habit_create') && Gate::denies('habit_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Habit();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
