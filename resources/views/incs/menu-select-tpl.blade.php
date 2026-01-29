@if ($item['id'] != 1)
    <option value="{{ $item['id'] }}" wire:key="{{ $item['id'] }}" 
    {!! $item['parent_id'] == 0 ? ' class="font-weight-bold"' : '' !!}
    @if (isset($this->id) && $item['id'] == $this->id) disabled style="color:rgb(115, 219, 146);" @endif>
        {!! $tab . $item['title'] !!} @if (isset($this->id) && $item['id'] == $this->id) (current) @endif
    </option>
@endif

@if (isset($item['children']))
    {!! \App\Helpers\Category\Category::getHtml($item['children'], "&nbsp;$tab - ") !!}
@endif