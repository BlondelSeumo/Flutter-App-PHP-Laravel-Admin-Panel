<div class='btn-group btn-group-sm'>
  @can('faqCategories.show')
  <a data-toggle="tooltip" data-placement="bottom" title="{{trans('lang.view_details')}}" href="{{ route('faqCategories.show', $id) }}" class='btn btn-link'>
    <i class="fa fa-eye"></i>
  </a>
  @endcan

  @can('faqCategories.edit')
  <a data-toggle="tooltip" data-placement="bottom" title="{{trans('lang.faq_category_edit')}}" href="{{ route('faqCategories.edit', $id) }}" class='btn btn-link'>
    <i class="fa fa-edit"></i>
  </a>
  @endcan

  @can('faqCategories.destroy')
{!! Form::open(['route' => ['faqCategories.destroy', $id], 'method' => 'delete']) !!}
  {!! Form::button('<i class="fa fa-trash"></i>', [
  'type' => 'submit',
  'class' => 'btn btn-link text-danger',
  'onclick' => "return confirm('Are you sure?')"
  ]) !!}
{!! Form::close() !!}
  @endcan
</div>
