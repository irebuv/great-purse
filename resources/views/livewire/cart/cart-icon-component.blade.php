<div class="justify-self-right position-relative ml-2 mr-3-sm" id="open-basket">
    <button class="btn-without-style">
        <img height="40" src="{{ asset('image/basket.png') }}" alt="basket">
    </button>
    <div class="count-cart font-20 grid place-center">
        <span class="text-center">
            {{ \App\Helpers\Cart\Cart::getCartQuantityItems() }}
        </span>
    </div>
</div>