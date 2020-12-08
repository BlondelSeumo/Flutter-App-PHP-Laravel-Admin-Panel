@foreach($items as $key => $item)
    @if(!is_array($item))
        @component('layouts.components.lang_item',[
            'item' => $item,
            'name' => $older6.'|'.$key,
            'key' => $key,
            'keyWithFileName' => $olderP.".".$key])
        @endcomponent
    @elseif(is_array($childItem))
        @component('layouts.components.lang_items',[
            'items' => $childItem,
            'key' => $childKey,
            'filename' => $filename,
            'key' => $key.'.'.$childKey,
            'keyWithFileName' => $filename.".".$key.".".$childKey])
        @endcomponent
    @endif
@endforeach