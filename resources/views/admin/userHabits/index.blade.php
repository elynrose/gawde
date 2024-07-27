@extends('layouts.admin')
@section('content')
@can('user_habit_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.user-habits.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.userHabit.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.userHabit.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-UserHabit">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.userHabit.fields.user') }}
                        </th>
                        <th>
                            {{ trans('cruds.userHabit.fields.habit') }}
                        </th>
                        <th>
                            {{ trans('cruds.userHabit.fields.notify_by_email') }}
                        </th>
                        <th>
                            {{ trans('cruds.userHabit.fields.send_sms_reminder') }}
                        </th>
                        <th>
                            {{ trans('cruds.userHabit.fields.agreed_to_terms') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($userHabits as $key => $userHabit)
                        <tr data-entry-id="{{ $userHabit->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $userHabit->user->name ?? '' }}
                            </td>
                            <td>
                                {{ $userHabit->habit->name ?? '' }}
                            </td>
                            <td>
                                <span style="display:none">{{ $userHabit->notify_by_email ?? '' }}</span>
                                <input type="checkbox" disabled="disabled" {{ $userHabit->notify_by_email ? 'checked' : '' }}>
                            </td>
                            <td>
                                <span style="display:none">{{ $userHabit->send_sms_reminder ?? '' }}</span>
                                <input type="checkbox" disabled="disabled" {{ $userHabit->send_sms_reminder ? 'checked' : '' }}>
                            </td>
                            <td>
                                <span style="display:none">{{ $userHabit->agreed_to_terms ?? '' }}</span>
                                <input type="checkbox" disabled="disabled" {{ $userHabit->agreed_to_terms ? 'checked' : '' }}>
                            </td>
                            <td>
                                @can('user_habit_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.user-habits.show', $userHabit->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('user_habit_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.user-habits.edit', $userHabit->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('user_habit_delete')
                                    <form action="{{ route('admin.user-habits.destroy', $userHabit->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('user_habit_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.user-habits.massDestroy') }}",
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
  let table = $('.datatable-UserHabit:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection