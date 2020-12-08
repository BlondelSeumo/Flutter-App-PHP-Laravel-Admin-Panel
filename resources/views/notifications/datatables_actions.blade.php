<div class='btn-group btn-group-sm'>
  @can('notifications.show')
  <a data-toggle="tooltip" data-placement="bottom" title="{{trans('lang.notification_read')}}" href="{{ route('notifications.show', $id) }}" class='btn btn-link'>
    <i class="fa fa-eye"></i>
  </a>
  @endcan

  @can('notifications.edit')
  <a data-toggle="tooltip" data-placement="bottom" title="{{trans('lang.notification_edit')}}" href="{{ route('notifications.edit', $id) }}" class='btn btn-link'>
    <i class="fa fa-edit"></i>
  </a>
  @endcan

  @can('notifications.destroy')
{!! Form::open(['route' => ['notifications.destroy', $id], 'method' => 'delete']) !!}
  {!! Form::button('<i class="fa fa-trash"></i>', [
  'type' => 'submit',
  'class' => 'btn btn-link text-danger',
  'onclick' => "return confirm('Are you sure?')"
  ]) !!}
{!! Form::close() !!}
  @endcan
</div>
