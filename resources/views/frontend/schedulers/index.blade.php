@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('scheduler_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('frontend.schedulers.create') }}">
                            {{ trans('global.add') }} {{ trans('cruds.scheduler.title_singular') }}
                        </a>
                    </div>
                </div>
            @endcan
            <div class="card">
                <div class="card-header">
                    {{ trans('cruds.scheduler.title_singular') }} {{ trans('global.list') }}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-Scheduler">
                            <thead>
                                <tr>
                                    <th>
                                        {{ trans('cruds.scheduler.fields.habit') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.scheduler.fields.today') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.scheduler.fields.user') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.scheduler.fields.reminded') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($schedulers as $key => $scheduler)
                                    <tr data-entry-id="{{ $scheduler->id }}">
                                        <td>
                                            {{ $scheduler->habit->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $scheduler->today ?? '' }}
                                        </td>
                                        <td>
                                            {{ $scheduler->user->name ?? '' }}
                                        </td>
                                        <td>
                                            <span style="display:none">{{ $scheduler->reminded ?? '' }}</span>
                                            <input type="checkbox" disabled="disabled" {{ $scheduler->reminded ? 'checked' : '' }}>
                                        </td>
                                        <td>
                                            @can('scheduler_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.schedulers.show', $scheduler->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('scheduler_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('frontend.schedulers.edit', $scheduler->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('scheduler_delete')
                                                <form action="{{ route('frontend.schedulers.destroy', $scheduler->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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

        </div>
    </div>
</div>
@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('scheduler_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('frontend.schedulers.massDestroy') }}",
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
    order: [[ 2, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-Scheduler:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection