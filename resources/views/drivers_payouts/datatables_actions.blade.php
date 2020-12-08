<div class='btn-group btn-group-sm'>
  @can('driversPayouts.show')
  <a data-toggle="tooltip" data-placement="bottom" title="{{trans('lang.view_details')}}" href="{{ route('driversPayouts.show', $id) }}" class='btn btn-link'>
    <i class="fa fa-eye"></i>
  </a>
  @endcan

  @can('driversPayouts.edit')
  <a data-toggle="tooltip" data-placement="bottom" title="{{trans('lang.drivers_payout_edit')}}" href="{{ route('driversPayouts.edit', $id) }}" class='btn btn-link'>
    <i class="fa fa-edit"></i>
  </a>
  @endcan

  @can('driversPayouts.destroy')
{!! Form::open(['route' => ['driversPayouts.destroy', $id], 'method' => 'delete']) !!}
  {!! Form::button('<i class="fa fa-trash"></i>', [
  'type' => 'submit',
  'class' => 'btn btn-link text-danger',
  'onclick' => "return confirm('Are you sure?')"
  ]) !!}
{!! Form::close() !!}
  @endcan
</div>
