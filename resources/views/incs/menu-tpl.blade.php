 <li wire:key="{{ $item['id'] }}"{{-- onclick="showTreeParent(this)" --}}
     class="dad @if (isset($item['children'])) next-sib dropend p-relative @endif 
      @if ($item['parent_id'] != 0) catalog-li @endif @if ($item['parent_id'] == 0) dad2 @endif @if (isset($item['children'])) dad2 @endif">
     {{-- <a href="#" class="p-absolute w-100 h-100 link-tree" style="z-index: 44;"></a> --}}
     @if (isset($item['children']))
         <a wire:navigate wire:current="active" href="{{ route('category', $item['slug']) }}" class="p-relative">
             {{ $item['title'] }}
         </a>
         <ul class="drop-down p-absolute p-static-md none-d @if (isset($item['children'])) drop-down-bg @endif">
             {!! \App\Helpers\Category\Category::getHtml($item['children']) !!}
         </ul>
     @else
         <a wire:current="active" class="dropdown-item" href="{{ route('category', $item['slug']) }}">
             {{ $item['title'] }}
         </a>
     @endif

 </li>
