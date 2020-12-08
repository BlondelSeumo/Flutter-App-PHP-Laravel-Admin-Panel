<div class='btn-group btn-group-sm'>
  @can('restaurantsPayouts.show')
  <a data-toggle="tooltip" data-placement="bottom" title="{{trans('lang.view_details')}}" href="{{ route('restaurantsPayouts.show', $id) }}" class='btn btn-link'>
    <i class="fa fa-eye"></i>
  </a>
  @endcan

  @can('restaurantsPayouts.edit')
  <a data-toggle="tooltip" data-placement="bottom" title="{{trans('lang.restaurants_payout_edit')}}" href="{{ route('restaurantsPayouts.edit', $id) }}" class='btn btn-link'>
    <i class="fa fa-edit"></i>
  </a>
  @endcan

  @can('restaurantsPayouts.destroy')
{!! Form::open(['route' => ['restaurantsPayouts.destroy', $id], 'method' => 'delete']) !!}
  {!! Form::button('<i class="fa fa-trash"></i>', [
  'type' => 'submit',
  'class' => 'btn btn-link text-danger',
  'onclick' => "return confirm('Are you sure?')"
  ]) !!}
{!! Form::close() !!}
  @endcan
</div>
