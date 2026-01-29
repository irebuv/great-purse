@if ($item['id'] != 1)
    <tr wire:key="{{ $item['id'] }}">
        <td class="text-center">{{ $item['id'] }}</td>
        <td><span style="padding-left: {{ strlen($tab) * 10 }}px;"  {!! $item['parent_id'] == 0 ? ' class="font-weight-bold"' : '' !!}>{{ $tab . $item['title'] }}</span></td>
        <td>
            <a href="{{ route('category', $item['slug']) }}" target="_blank" class="btn btn-info btn-circle">
                <i class="fa fa-eye"></i>
            </a>
            <a wire:navigate href="{{ route('admin.categories.edit', $item['id']) }}" class="btn btn-warning btn-circle">
                <i class="fa fa-pen"></i>
            </a>
            <button wire:loading.atrr="disabled" wire:click="deleteCategory({{ $item['id'] }})"
             wire:confirm="Are you sure?" class="btn btn-danger btn-circle">
                <i class="fa fa-trash"></i>
            </button>
        </td>
    </tr>
@endif
@if (isset($item['children']))
    {!! \App\Helpers\Category\Category::getHtml($item['children'], "$tab - ") !!}
@endif