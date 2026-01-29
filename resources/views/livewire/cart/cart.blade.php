<div>
    @section('metatags')
        <title>{{ config('app.name') . ' :: ' . $title ?? 'Great purse' }}</title>
        <meta name="description" content="{{ $desc ?? '' }}">
    @endsection
    <section class="container mt-3 pd-l-r-0">
        <div class="p-3 justify-self-left bg-lightbrown">
            <a wire:navigate href="{{ route('home') }}">
                <span class="text-brown">Home</span> /
            </a>
            <span>Cart</span>
        </div>
        <div class="mt-3 grid grid-collumns-cart gap-20">
            <div class="bg-lightbrown p-3 p-relative">
                <div wire:loading wire:target.except="add2Cart" class="loader loader-cart">
                    <div class="rotate mt-4"></div>
                </div>
                @if ($cart = \App\Helpers\Cart\Cart::getCart())
                    <div class="grid grid-collumns-cart-item align-center gap-30 bg-lightbrown p-2 font-20">
                        <div class="text-center">
                            Photo
                        </div>
                        <div class="text-center">
                            Product
                        </div>
                        <div class="text-center">
                            Price
                        </div>
                        <div class="text-center">
                            Qty
                        </div>
                        <div class="text-center">
                            Total
                        </div>
                        <div class="mr-2">
                            <img width="30" src="{{ asset('image/basket.png') }}" alt="trash-can">
                        </div>
                    </div>
                    @foreach ($cart as $id => $item)
                        <div wire:key="{{ $id }}"
                            class="grid grid-collumns-cart-item align-center gap-30 mt-3 mb-3 p-2 bg-lightbrown">
                            <div class="image-product-basket">
                                <a wire:navigate href="{{ route('product', $item['slug']) }}">
                                    <img src="{{ asset($item['image']) }}">
                                </a>
                            </div>
                            <div>
                                <a wire:navigate class="text-black font-20" href="{{ route('product', $item['slug']) }}">
                                    {{ $item['title'] }}
                                </a>
                            </div>
                            <div class="text-center">
                                <span class="font-20">
                                    ${{ $item['price'] }}
                                </span>
                            </div>
                            <div>
                                <div class="quantity grid grid-collumns-3 align-center justify-between-g">
                                    <button wire:click="decrementQuantity({{ $id }})" class="btn-without-style minus">
                                        <img width="25px" height="25px" src="{{ asset('image/minus.png') }}" alt="minus">
                                    </button>
                                    <input wire:model.live="quantities.{{ $id }}" class="text-center font-32 num text-brown">
                                    <button wire:click="increaseQuantity({{ $id }})" class="btn-without-style plus">
                                        <img width="25px" height="25px" src="{{ asset('image/plus.png') }}" alt="plus">
                                    </button>
                                </div>
                            </div>
                            {{-- <div x-data="{ qty: {{ $item['quantity'] }} }">
                                <div class="quantity quantity-cart grid align-center justify-between-g">
                                    <input x-model="qty" value="{{ $item['quantity'] }}"
                                        class="text-center font-32 num text-brown" type="number">
                                    <button x-on:click="$wire.updateItemQuantity({{ $id }}, qty)"
                                        class="btn-without-style plus">
                                        <img width="25px" height="25px" src="{{ asset('image/rotate.png') }}" alt="plus">
                                    </button>
                                </div>
                            </div> --}}
                            <div class="text-center">
                                <span class="font-20"><b>${{ $item['price'] * $item['quantity'] }}</b></span>
                            </div>
                            <div>
                                <button wire:click="removeFromCart({{ $id }})" wire:loading.attr="disabled"
                                    wire:target="updateItemQuantity, removeFromCart, clearCart"
                                    class="btn-without-style btn-with-image btn-delete"></button>
                            </div>
                        </div>
                    @endforeach
                    <div>
                        <button wire:click="clearCart" wire:loading.attr="disabled" wire:target="clearCart"
                            class="btn-def btn-black btn-cart">Clear all</button>
                    </div>
                @else
                    <div class="grid place-center w-100 h-100">
                        <span class="font-32">There's no items...</span>
                    </div>
                @endif
            </div>
            <div class="bg-lightbrown p-3 align-self-start">
                <h3 class="font-24">Cart summary</h3>
                <div class="grid grid-collumns-2 text-brown mt-4 font-20">
                    <span>Items:</span>
                    <span class="text-right">{{ App\Helpers\Cart\Cart::getCartQuantityTotal() }}</span>
                </div>
                <div class="grid grid-collumns-2 text-brown mt-2 mb-3 font-20">
                    <span>Products:</span>
                    <span class="text-right">{{ App\Helpers\Cart\Cart::getCartQuantityItems() }}</span>
                </div>
                <hr>
                <div class="grid grid-collumns-2 mt-3 font-24">
                    <span><b>Total:</b></span>
                    <span class="text-right">
                        <b>{{ \Illuminate\Support\Number::currency(App\Helpers\Cart\Cart::getCartTotalSum(), in: 'USD', precision: 0) }}</b>
                    </span>
                </div>
                @if ($cart)
                    <a wire:navigate href="{{ route('checkout') }}">
                        <button class="btn-def btn-brown mt-4 mb-2">Checkout</button>
                    </a>
                @endif
            </div>
        </div>
    </section>
</div>