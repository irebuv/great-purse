<aside wire:ignore.self class="basket p-4 mb-4 p-0-xs" id="basket">
    <div class="grid grid-collumns-2 align-center p-3-xs">
        <h5 class="text-left font-24">Card ({{ \App\Helpers\Cart\Cart::getCartQuantityTotal() }} items)</h5>
        <button class="btn-without-style font-24 justify-self-right close btn-with-image"></button>
    </div>

    <div class="p-2-xs">
        @if ($cart = \App\Helpers\Cart\Cart::getCart())

        @foreach ($cart as $id => $item)
            <div wire:key="{{ $id }}" class="grid grid-columns-basket align-center collumn-gap-30 font-20 mt-2 mb-2">
                <div class="image-product-basket">
                    <a wire:navigate href="{{ route('product', $item['slug']) }}">
                        <img src="{{ asset($item['image']) }}" class="img-square-def">
                    </a>
                </div>
                <div>
                    <a wire:navigate class="text-black" href="{{ route('product', $item['slug']) }}">{{ $item['title'] }}</a>
                </div>
                <div>
                    <span><b>${{ $item['price'] }}</b></span>
                </div>
                <div>
                    <span><b>&times;{{ $item['quantity'] }}</b></span>
                </div>
                <div>
                    <button wire:click="removeFromCart({{ $id }})" wire:loading.attr="disabled" wire:target="removeFromCart"
                    class="btn-without-style font-32 btn-with-image btn-delete"></button>
                </div>
            </div>
            <hr>
        @endforeach

        <div class="p-t-b-3">
            <p class="text-right font-24">Total: <b>${{ \App\Helpers\Cart\Cart::getCartTotalSum() }}</b></p>
        </div>
        <hr>
        <div class="grid grid-collumns-2-auto justify-right mt-4">
            <a wire:navigate href="{{ route('cart') }}">
                <button class="btn-def btn-square btn-gray">Cart</button>
            </a>
            <a wire:navigate href="{{ route('checkout') }}">
                <button class="ml-2 btn-def btn-square btn-brown">Checkout</button>
            </a>
        </div>
    @else
        <p class="font-32 mt-4">Cart is empty...</p>
    @endif
    </div>
    

</aside>