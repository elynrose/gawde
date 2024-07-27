@extends('layouts.admin')
@section('content')
@can('habit_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.habits.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.habit.title_singular') }}
            </a>
            <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                {{ trans('global.app_csvImport') }}
            </button>
            @include('csvImport.modal', ['model' => 'Habit', 'route' => 'admin.habits.parseCsvImport'])
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.habit.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Habit">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.habit.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.habit.fields.description') }}
                        </th>
                        <th>
                            {{ trans('cruds.habit.fields.photo') }}
                        </th>
                        <th>
                            {{ trans('cruds.habit.fields.active') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($habits as $key => $habit)
                        <tr data-entry-id="{{ $habit->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $habit->name ?? '' }}
                            </td>
                            <td>
                                {{ $habit->description ?? '' }}
                            </td>
                            <td>
                                @if($habit->photo)
                                    <a href="{{ $habit->photo->getUrl() }}" target="_blank" style="display: inline-block">
                                        <img src="{{ $habit->photo->getUrl('thumb') }}">
                                    </a>
                                @endif
                            </td>
                            <td>
                                <span style="display:none">{{ $habit->active ?? '' }}</span>
                                <input type="checkbox" disabled="disabled" {{ $habit->active ? 'checked' : '' }}>
                            </td>
                            <td>
                                @can('habit_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.habits.show', $habit->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('habit_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.habits.edit', $habit->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('habit_delete')
                                    <form action="{{ route('admin.habits.destroy', $habit->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
                                @endcan

                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('habit_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.habits.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-Habit:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection