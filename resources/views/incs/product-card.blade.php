<div class="p-relative h-100">
    <div class="mark text-white font-20">
        @if ($product->is_hit)
            <div class="mark-hit mb-1">
                HIT
            </div>
        @endif
        @if ($product->is_new)
            <div class="mark-new">
                NEW
            </div>
        @endif
    </div>
    <div class="featured-goods h-100 grid">
        <a wire:navigate href="{{ route('product', $product->slug) }}">
            <img src="{{ asset($product->getImage()) }}">
        </a>
        <div class="grid grid-columns-product mt-3 mb-3 align-center">
            <div class="ml-2">
                <div wire:loading.remove wire:target="add2Wish({{ $product->id }})"
                    wire:click="add2Wish({{ $product->id }})">
                    <button wire:loading.attr="disabled" class="c-pointer btn-without-style">
                        <img width="40" alt="heart" @if (in_array($product->id, $act_wish))
                            src="{{ asset('image/heart-act.png') }}" @endif src="{{ asset('image/heart-dis.png') }}">
                    </button>
                </div>

                <div wire:loading wire:target="add2Wish({{ $product->id }})"
                    style="width: 40px; height: 40px; font-size: 40px;">
                    <div class="rotate"></div>
                </div>
            </div>
            <div class="text-center font-20 text-black">
                <a wire:navigate href="{{ route('product', $product->slug) }}">
                    <p class="ml-3 mr-3">{{ $product->title }}</p>
                    @if ($product->old_price)
                        <p class="price-block">
                            <span>{{ $product->old_price }}$</span>
                            {{ $product->price }}$
                        </p>
                    @else
                        <p class="price-common">
                            {{ $product->price }}$
                        </p>
                    @endif
                </a>
                <div class="grid grid-collumns-3-max-content justify-center-g align-center mt-2">
                    <a href="{{ route('product', [$product->slug, 'review_js' => 'true']) }}#descriptions"
                        class="p-relative stars-range-a mt-1">
                        <img src="{{ asset('image/comment.png') }}" height="35" alt="">
                        <div class="text-brown">{{ $product->reviews }}</div>
                    </a>
                    <div class="p-relative stars-range ml-2 mr-1">
                        <div></div>
                        <div style="width: {{ $product->evaluation * 20 }}%;"></div>
                    </div>
                    <div class="text-brown">
                        @if ($product->evaluation != 0)
                            {{ $product->evaluation }}
                        @endif
                    </div>
                </div>
                {{-- <div class="star-rating">
                    <input type="radio" id="{{ $product->slug }}-5" name="{{ $product->slug }}" value="5" />
                    <label for="{{ $product->slug }}-5" title="5 stars"></label>
                    <input type="radio" id="{{ $product->slug }}-4" name="{{ $product->slug }}" value="4" />
                    <label for="{{ $product->slug }}-4" title="4 stars"></label>
                    <input type="radio" id="{{ $product->slug }}-3" name="{{ $product->slug }}" value="3" />
                    <label for="{{ $product->slug }}-3" title="3 stars"></label>
                    <input type="radio" id="{{ $product->slug }}-2" name="{{ $product->slug }}" value="2" />
                    <label for="{{ $product->slug }}-2" title="2 stars"></label>
                    <input type="radio" id="{{ $product->slug }}-1" name="{{ $product->slug }}" value="1" />
                    <label for="{{ $product->slug }}-1" title="1 star"></label>
                </div> --}}
            </div>
            <div class="justify-self-right mr-2">
                <div wire:loading.remove wire:target="add2Cart({{ $product->id }})"
                    wire:click="add2Cart({{ $product->id }})">
                    <button wire:loading.attr="disabled" class="btn-without-style btn-card btn-with-image"></button>
                </div>

                <div wire:loading wire:target="add2Cart({{ $product->id }})"
                    style="width: 40px; height: 40px; font-size: 40px;">
                    <div class="rotate"></div>
                </div>
            </div>
        </div>
    </div>

</div>

<script>
       


    function updateRating() {
        const range = document.querySelector('input[type="range"]');
        const stars = document.querySelectorAll('.star');
        const rating = parseInt(range.value);

        stars.forEach((star, index) => {
            if (index < rating) {
                star.classList.add('active');
            } else {
                star.classList.remove('active');
            }
        });
    }
</script>