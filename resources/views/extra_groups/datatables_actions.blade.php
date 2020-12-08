<div class='btn-group btn-group-sm'>
  @can('extraGroups.show')
  <a data-toggle="tooltip" data-placement="bottom" title="{{trans('lang.view_details')}}" href="{{ route('extraGroups.show', $id) }}" class='btn btn-link'>
    <i class="fa fa-eye"></i>
  </a>
  @endcan

  @can('extraGroups.edit')
  <a data-toggle="tooltip" data-placement="bottom" title="{{trans('lang.extra_group_edit')}}" href="{{ route('extraGroups.edit', $id) }}" class='btn btn-link'>
    <i class="fa fa-edit"></i>
  </a>
  @endcan

  @can('extraGroups.destroy')
{!! Form::open(['route' => ['extraGroups.destroy', $id], 'method' => 'delete']) !!}
  {!! Form::button('<i class="fa fa-trash"></i>', [
  'type' => 'submit',
  'class' => 'btn btn-link text-danger',
  'onclick' => "return confirm('Are you sure?')"
  ]) !!}
{!! Form::close() !!}
  @endcan
</div>
