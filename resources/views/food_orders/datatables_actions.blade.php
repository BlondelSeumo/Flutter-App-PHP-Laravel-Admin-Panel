<div class='btn-group btn-group-sm'>
  @can('foodOrders.show')
  <a data-toggle="tooltip" data-placement="bottom" title="{{trans('lang.view_details')}}" href="{{ route('foodOrders.show', $id) }}" class='btn btn-link'>
    <i class="fa fa-eye"></i>
  </a>
  @endcan

  @can('foodOrders.edit')
  <a data-toggle="tooltip" data-placement="bottom" title="{{trans('lang.food_order_edit')}}" href="{{ route('foodOrders.edit', $id) }}" class='btn btn-link'>
    <i class="fa fa-edit"></i>
  </a>
  @endcan

    @can('orders.edit')
      <a data-toggle="tooltip" data-placement="bottom" title="{{trans('lang.order_edit')}}" href="{{ route('orders.edit', $order['id']) }}" class='btn btn-link'>
        <i class="fa fa-tasks"></i>
      </a>
    @endcan

  @can('foodOrders.destroy')
{!! Form::open(['route' => ['foodOrders.destroy', $id], 'method' => 'delete']) !!}
  {!! Form::button('<i class="fa fa-trash"></i>', [
  'type' => 'submit',
  'class' => 'btn btn-link text-danger',
  'onclick' => "return confirm('Are you sure?')"
  ]) !!}
{!! Form::close() !!}
  @endcan
</div>
