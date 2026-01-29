<aside wire:ignore.self class="basket p-4 p-0-xs mb-4 wish-list-main" id="wish-list">
    <div class="grid grid-collumns-2-fr-auto align-center mb-4 p-3-xs">
        <h5 class="text-left font-24">Wishlist ({{ count(\App\Helpers\Wish\Wish::activeWishProduct()) }} items)</h5> 
        
        <button class="btn-without-style font-24 justify-self-right close btn-with-image"></button>
    </div>

    @if ($wish = \App\Helpers\Wish\Wish::getWish())
        @foreach ($wish as $item)
            <div wire:key="{{ $item->product_id }}"
                class="grid grid-columns-wish wish-list-main-block align-center collumn-gap-30 font-20 mt-3 mb-3">
                <div class="image-product-basket">
                    <a wire:navigate href="{{ route('product', $item->slug) }}">
                        <img src="{{ asset($item->image) }}" class="img-square-def">
                    </a>
                </div>
                <div>
                    <a wire:navigate class="text-black" href="{{ route('product', $item->slug) }}">{{ $item->title }}</a>
                </div>

                <div class="justify-self-right mr-2 grid grid-collumns-2 align-center">
                    <div wire:loading.remove wire:target="add2Cart({{ $item->product_id }})" style="margin-top: -3px;"
                        wire:click="add2Cart({{ $item->product_id }})">
                        <button wire:loading.attr="disabled" class="btn-without-style btn-card btn-with-image"></button>
                    </div>

                    <div wire:loading wire:target="add2Cart({{ $item->product_id }})" style="margin-top: -3px;"
                        style="width: 40px; height: 40px; font-size: 40px;">
                        <div class="rotate"></div>
                    </div>
                    <button wire:click="removeFromWish({{ $item->product_id }})" wire:loading.attr="disabled"
                        wire:target="removeFromWish" class="btn-without-style font-32 btn-with-image btn-delete ml-2"></button>
                </div>

                <div>
                </div>
            </div>
        @endforeach
        <hr>
        <div class="grid grid-collumns-2-auto justify-right mt-3">
                <button wire:click="clearWish()" class="ml-2 btn-def btn-square btn-brown">Clear all</button>
           
        </div>
    @else
        <p class="font-32 mt-4">Wishlist is empty...</p>
    @endif
</aside>