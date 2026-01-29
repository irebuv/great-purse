<div>
    @section('metatags')
        <title>{{ config('app.name') . ' :: ' . $title ?? 'Great purse' }}</title>
        <meta name="description" content="{{ $desc ?? '' }}">
    @endsection
    <section class="container mt-3 pd-l-r-0">
        <div class="gallery">
            <button id="closeGallery"
                class="btn-without-style justify-self-right close close-flash-msg btn-with-image close-flash">
            </button>
            <div class="h-100 gap-30">
                <div class="main-image p-relative">
                    <div class="loading">
                        <div class="rotate"></div>
                    </div>
                    <img class="justify-self-center" height="100%" src="" alt="empty">
                    <button class="prev-big">
                        <img src="{{ asset('image/next-image.png') }}" alt="prev">
                    </button>
                    <button class="next-big">
                        <img src="{{ asset('image/next-image.png') }}" alt="next">
                    </button>

                </div>
                <div class="grid align-center grid-collumns-gallery justify-center-g p-relative">
                    <div class="mr-3 prev-small">
                        <img src="{{ asset('image/next-image.png') }}" alt="prev">
                    </div>
                    <div style="overflow: hidden">
                        <div id="scroll-carousel" class="w-100">
                            <div class="carousel-products">
                                @if ($product->gallery)
                                    <img src="{{ asset($product->getImage()) }}" class="active-product img-square-def">
                                    @foreach ($product->gallery as $item)
                                        <img src="{{ asset($item) }}" class="img-square-def">
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="ml-3 next-small">
                        <img src="{{ asset('image/next-image.png') }}" alt="next">
                    </div>
                </div>

            </div>

        </div>

        <div class="p-3 justify-self-left bg-lightbrown">
            <a wire:navigate href="{{ route('home') }}">
                <span class="text-brown">Home</span> /
            </a>

            @foreach ($breadcrumbs as $breadcrumb_slug => $breadcrumb_title)
                <a wire:navigate href="{{ route('category', $breadcrumb_slug) }}">
                    <span class="text-brown">{{ $breadcrumb_title }}</span> /
                </a>
            @endforeach

            <span>{{ $product->title }}</span>
        </div>
        <div class="product grid mt-3">
            <div class="">
                <div class="p-relative product-main-image mb-2">
                    <div class="loading">
                        <div class="rotate"></div>
                    </div>
                    <img id="open-gallery" class="w-100 img-square-def" src="{{ asset($product->getImage()) }}">
                    @if ($product->gallery)
                        <button class="font-48 prev-product">
                            <img src="{{ asset('image/next-image.png') }}" alt="prev">
                        </button><button class="font-48 next-product">
                            <img src="{{ asset('image/next-image.png') }}" alt="next">
                        </button>
                    @endif
                </div>
                <div class="grid grid-collumns-6 gap-10 mt-1 carousel-product">
                    @if ($product->gallery)
                        <img src="{{ asset($product->getImage()) }}" class="w-100 active-product img-square-def">
                        @foreach ($product->gallery as $item)
                            <img src="{{ asset($item) }}" class="w-100 img-square-def">
                        @endforeach
                    @endif
                </div>
            </div>
            <div class="bg-lightbrown p-3 grid align-between gap-20">
                <h3 class="text-uppercase font-24">{{ $product->title }}</h3>
                <div>
                    @if ($product->old_price)
                        <p class="price-block">
                            <span class="font-20">{{ $product->old_price }}$</span>
                            <span class="font-32">{{ $product->price }}$</span>
                        </p>
                    @else
                        <p class="price-common font-32">
                            {{ $product->price }}$
                        </p>
                    @endif
                </div>
                <div>
                    <p class="font-20">{{ $product->excerpt }}</p>
                </div>
                <div>
                    <div class="grid grid-collumns-3-max-content align-center">
                        <div class="quantity grid grid-collumns-3 align-center justify-between-g">
                            <button wire:click="decrementQuantityProduct({{ $product->id }})"
                                class="btn-without-style minus">
                                <img width="25px" height="25px" src="{{ asset('image/minus.png') }}" alt="minus">
                            </button>
                            <input wire:model="quantity" class="text-center font-32 num text-brown">
                            <button wire:click="increaseQuantityProduct({{ $product->id }})"
                                class="btn-without-style plus">
                                <img width="25px" height="25px" src="{{ asset('image/plus.png') }}" alt="plus">
                            </button>
                        </div>
                        <button wire:click="add2Cart({{ $product->id }}, true)" wire:loading.attr="disabled"
                            class="btn-def btn-square btn-brown mt-0 ml-1">Add to cart</button>
                        <div class="ml-2">
                            <div wire:click="add2Wish({{ $product->id }})" wire:loading.remove
                                wire:target="add2Wish({{ $product->id }})">
                                <button wire:loading.attr="disabled" class="c-pointer btn-without-style">
                                    <img width="40" alt="heart"
                                        @if (in_array($product->id, \App\Helpers\Wish\Wish::activeWishProduct())) src="{{ asset('image/heart-act.png') }}" @endif
                                        src="{{ asset('image/heart-dis.png') }}">
                                </button>
                            </div>

                            <div wire:loading wire:target="add2Wish({{ $product->id }})"
                                style="width: 40px; height: 40px; font-size: 40px;">
                                <div class="rotate"></div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-1">
                        <div class="grid grid-collumns-3-max-content align-center product-stars">
                            <a href="#descriptions" id="open-reviews" class="p-relative stars-range-a mt-1">
                                <img src="{{ asset('image/comment.png') }}" height="35" alt="">
                                <div class="text-brown" style="margin-top: 2px;">{{ $counter_commetns }}</div>
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
                    </div>
                </div>

                <div class="grid grid-collumns-3 gap-10 info-block">
                    <div class="grid">
                        <div class="grid grid-collumns-2-max-content align-center justify-center-g">
                            <img height="25px" src="{{ asset('image/shield.png') }}" alt="shield">
                            <h5 class="ml-2 font-20">Varanty</h5>
                        </div>

                        <ul class="mt-2 justify-self-center">
                            <li>- 1 year of varanty</li>
                            <li>- Return product in 14 days</li>
                            <li>- Varanty of quality</li>
                        </ul>
                    </div>
                    <div class="grid" id="descriptions">
                        <div class="grid grid-collumns-2-max-content align-center justify-center-g">
                            <img height="25px" src="{{ asset('image/credit-card.png') }}" alt="shield">
                            <h5 class="ml-2 font-20">Payment</h5>
                        </div>

                        <ul class="mt-2 justify-self-center">
                            <li>- Credit card pay</li>
                            <li>- Cash Payment</li>
                            <li>- VISA or MasterCard</li>
                        </ul>
                    </div>
                    <div class="grid">
                        <div class="grid grid-collumns-2-max-content align-center justify-center-g">
                            <img height="25px" src="{{ asset('image/truck.png') }}" alt="shield">
                            <h5 class="ml-2 font-20">Shipping</h5>
                        </div>

                        <ul class="mt-2 justify-self-center">
                            <li>- 1 year of varanty</li>
                            <li>- Return product in 14 days</li>
                            <li>- Varanty of quality</li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
        <div class="p-3 mt-3 bg-lightbrown">
            <div class="description-nav">
                <ul>
                    <li><button wire:ignore class="font-24 active" id="description">Description</button></li>
                    <li><button wire:ignore class="font-24" id="comments">Reviews</button></li>
                    @if ($attributes->isNotEmpty())
                        <li><button wire:ignore class="font-24" id="features">Features</button></li>
                    @endif
                </ul>
            </div>
            <div class="mt-3 font-20">
                <div wire:ignore.self id="comments-desc" class="none-d">
                    @include('incs.reviews')
                </div>
                <div wire:ignore.self id="description-desc" class="">{!! $product->content !!}</div>
                @if ($attributes->isNotEmpty())
                    <div wire:ignore.self id="features-desc" class="none-d">
                        @foreach ($attributes as $attribute)
                            <div class="grid grid-collumns-2-max-content features">
                                <div><b>{{ $attribute->filter_groups_title }}:</b></div>
                                <div>{{ $attribute->filters_title }}</div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </section>
    @php
        $act_wish = \App\Helpers\Wish\Wish::activeWishProduct();
    @endphp
    @if ($related_products->isNotEmpty())
        <section class="bg-gray p-t-b-4 mb-0">
            <div class="grid grid-collumns-6 gap-30">
                @foreach ($related_products as $product)
                    <div wire:key="{{ $product->id }}">
                        @include('incs.product-card')
                    </div>
                @endforeach
            </div>
        </section>
    @endif
</div>
