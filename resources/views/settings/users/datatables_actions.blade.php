{!! Form::open(['route' => ['users.destroy', $id], 'method' => 'delete']) !!}
<div class='btn-group btn-group-sm'>
    {{--<a data-toggle="tooltip" data-placement="bottom" title="{{trans('lang.user_edit')}}" href="{{ route('users.show', $id) }}" class='btn btn-link'>--}}
        {{--<i class="fa fa-eye"></i> </a>--}}
    <a data-toggle="tooltip" data-placement="bottom" title="{{trans('lang.user_edit')}}" href="{{ route('users.edit', $id) }}" class='btn btn-link'>
        <i class="fa fa-edit"></i> </a>
    {!! Form::button('<i class="fa fa-trash"></i>', [
    'data-toggle' => 'tooltip',
    'data-placement' => 'bottom',
    'title' => trans('lang.user_delete'),
    'type' => 'submit',
    'class' => 'btn btn-link text-danger',
    'onclick' => "swal({title: ".trans('lang.error').", confirmButtonText: ".trans('lang.ok').",
                            text: data.message,type: 'error', confirmButtonClass: 'btn-danger'});"
    ]) !!}

    <div class="dropdown">
        <a class="btn btn-link btn-sm dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-cog"></i> </a>
        <div class="dropdown-menu">
            <a class='dropdown-item' href="{{ route('users.login-as-user', $id) }}"> <i class="fa fa-sign-in mr-1"></i> {{trans('lang.user_login_as_user')}}
            </a>

            <a onclick="return swal({title: '{{trans('lang.error')}}'});" class='dropdown-item' href="{{ route('users.profile') }}"><i class="fa fa-user mr-1"></i> {{trans('lang.user_profile')}} </a>

        </div>
    </div>

</div>
{!! Form::close() !!}