<div class="p-relative">
    <div class="none-d d-none-lg d-block-md d-none-sm">
        <button id="search-md" type="submit" class="btn-without-style">
            <img width="30" src="{{ asset('image/search.png') }}" alt="search">
        </button>
    </div>
    <div wire:ignore.self class="d-block d-none-md d-block-sm search-md search-panel">
        @if (count($search_results))
            <div x-on:click="$wire.term = ''; $wire.$refresh()" class="shadow d-none-md d-block-sm search-shadow"></div>
        @endif
        <div class="search-form p-relative">
            <form wire:submit="search">
                <div class="grid grid-collumns-2-auto search justify-center-sm">
                    <input wire:model.live.debounce.500ms="term" type="text" placeholder="Searching..."
                        class="input-def w-100-xs @if (count($search_results)) search-act @endif">
                    <button type="submit" @if (!count($search_results)) disabled @endif>
                        @if (!count($search_results))
                            <img src="{{ asset('image/search.png') }}" alt="search">
                        @else
                            <img src="{{ asset('image/search-act.png') }}" alt="search">
                        @endif
                    </button>
                </div>
                @if ($term)
                    <button x-on:click="$wire.term = ''; $wire.$refresh()" type="button"
                        class="btn-without-style close btn-with-image search-empty"></button>
                @endif
            </form>

            @if (count($search_results))
                <ul class="search-results w-100">
                    @foreach ($search_results as $product)
                        <li><a wire:navigate href="{{ route('product', $product->slug) }}">
                                <img width="40px" src="{{ asset($product->image) }}" alt="{{ $product->slug }}">
                                <span>{{ $product->title }}</span><span><b>${{ $product->price }}</b></span>
                            </a></li>
                    @endforeach
                </ul>
            @endif

        </div>
    </div>

</div>
