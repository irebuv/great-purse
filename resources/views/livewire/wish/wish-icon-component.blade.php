<div class="justify-self-right position-relative justify-self-left-sm grid mr-2-xs open-wish">
    <button class="btn-without-style">
        <img height="40" src="{{ asset('image/heart-act.png') }}" alt="heart">
    </button>
    <div class="wish-cart font-16 grid place-center">
        <span class="text-center">
            @if (count(\App\Helpers\Wish\Wish::getWish()))
                {{ count(\App\Helpers\Wish\Wish::getWish()) }}
            @endif
        </span>
    </div>
</div>