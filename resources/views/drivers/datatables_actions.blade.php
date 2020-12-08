<div class='btn-group btn-group-sm'>
    @can('drivers.show')
        <a data-toggle="tooltip" data-placement="bottom" title="{{trans('lang.view_details')}}" href="{{ route('drivers.show', $id) }}" class='btn btn-link'>
            <i class="fa fa-eye"></i> </a>
    @endcan

    @can('drivers.edit')
        <a data-toggle="tooltip" data-placement="bottom" title="{{trans('lang.view_details')}}" href="{{ route('users.edit', $user_id) }}" class='btn btn-link'>
            <i class="fa fa-eye"></i> </a>
        <a data-toggle="tooltip" data-placement="bottom" title="{{trans('lang.driver_edit')}}" href="{{ route('drivers.edit', $id) }}" class='btn btn-link'>
            <i class="fa fa-edit"></i> </a>
    @endcan

    @can('drivers.destroy')
        {!! Form::open(['route' => ['drivers.destroy', $id], 'method' => 'delete']) !!}
        {!! Form::button('<i class="fa fa-trash"></i>', [
        'type' => 'submit',
        'class' => 'btn btn-link text-danger',
        'onclick' => "return confirm('Are you sure?')"
        ]) !!}
        {!! Form::close() !!}
    @endcan
</div>
