<div class='btn-group btn-group-sm'>
  @can('earnings.show')
  <a data-toggle="tooltip" data-placement="bottom" title="{{trans('lang.view_details')}}" href="{{ route('earnings.show', $id) }}" class='btn btn-link'>
    <i class="fa fa-eye"></i>
  </a>
  @endcan

    @can('restaurantsPayouts.create')
      <a data-toggle="tooltip" data-placement="bottom" title="{{trans('lang.restaurants_payout_create')}}" href="{{ route('restaurantsPayouts.create') }}" class='btn btn-link'>
        <i class="fa fa-money"></i>
      </a>
    @endcan

  @can('earnings.edit')
  <a data-toggle="tooltip" data-placement="bottom" title="{{trans('lang.earning_edit')}}" href="{{ route('earnings.edit', $id) }}" class='btn btn-link'>
    <i class="fa fa-edit"></i>
  </a>
  @endcan

  @can('earnings.destroy')
{!! Form::open(['route' => ['earnings.destroy', $id], 'method' => 'delete']) !!}
  {!! Form::button('<i class="fa fa-trash"></i>', [
  'type' => 'submit',
  'class' => 'btn btn-link text-danger',
  'onclick' => "return confirm('Are you sure?')"
  ]) !!}
{!! Form::close() !!}
  @endcan
</div>
