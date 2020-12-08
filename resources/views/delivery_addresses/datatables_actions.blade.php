<div class='btn-group btn-group-sm'>
  @can('deliveryAddresses.show')
  <a data-toggle="tooltip" data-placement="bottom" title="{{trans('lang.view_details')}}" href="{{ route('deliveryAddresses.show', $id) }}" class='btn btn-link'>
    <i class="fa fa-eye"></i>
  </a>
  @endcan

  @can('deliveryAddresses.edit')
  <a data-toggle="tooltip" data-placement="bottom" title="{{trans('lang.delivery_address_edit')}}" href="{{ route('deliveryAddresses.edit', $id) }}" class='btn btn-link'>
    <i class="fa fa-edit"></i>
  </a>
  @endcan

  @can('deliveryAddresses.destroy')
{!! Form::open(['route' => ['deliveryAddresses.destroy', $id], 'method' => 'delete']) !!}
  {!! Form::button('<i class="fa fa-trash"></i>', [
  'type' => 'submit',
  'class' => 'btn btn-link text-danger',
  'onclick' => "return confirm('Are you sure?')"
  ]) !!}
{!! Form::close() !!}
  @endcan
</div>
