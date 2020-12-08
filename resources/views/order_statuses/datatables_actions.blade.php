<div class='btn-group btn-group-sm'>
  @can('orderStatuses.show')
  <a data-toggle="tooltip" data-placement="bottom" title="{{trans('lang.view_details')}}" href="{{ route('orderStatuses.show', $id) }}" class='btn btn-link'>
    <i class="fa fa-eye"></i>
  </a>
  @endcan

  @can('orderStatuses.edit')
  <a data-toggle="tooltip" data-placement="bottom" title="{{trans('lang.order_status_edit')}}" href="{{ route('orderStatuses.edit', $id) }}" class='btn btn-link'>
    <i class="fa fa-edit"></i>
  </a>
  @endcan

  @can('orderStatuses.destroy')
{!! Form::open(['route' => ['orderStatuses.destroy', $id], 'method' => 'delete']) !!}
  {!! Form::button('<i class="fa fa-trash"></i>', [
  'type' => 'submit',
  'class' => 'btn btn-link text-danger',
  'onclick' => "return confirm('Are you sure?')"
  ]) !!}
{!! Form::close() !!}
  @endcan
</div>
