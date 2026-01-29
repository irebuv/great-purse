<div>
    @section('metatags')
        <title>{{ config('app.name') . ' :: ' . $title ?? 'Great purse' }}</title>
        <meta name="description" content="{{ $desc ?? '' }}">
    @endsection
    <section class="container w-100-sm mt-3 pd-l-r-0">
        <h2 class="font-48 mt-3 mb-4 text-brown">Welcome, {{ auth()->user()->name }}!</h2>
        <div class="p-3 justify-self-left bg-lightbrown">
            <a wire:navigate href="{{ route('home') }}">
                <span class="text-brown">Home</span> /
            </a>
            <a wire:navigate href="{{ route('account') }}">
                <span class="text-brown">Account</span> /
            </a>
            <span>Order show</span>
        </div>
        <div class="mt-3 grid grid-collumns-2-13 coll-12-md coll-1-sm gap-20 account-posibilities">
            <div wire:ignore class="bg-lightbrown p-3 p-relative font-24 align-self-start">
                <ul>
                    <li class="mt-2 mb-2 ml-3 active">
                        <a wire:navigate class="text-brown" href="{{ route('account') }}">Back to account</a>
                    </li>
                </ul>
            </div>
            <div wire:ignore class="bg-lightbrown p-3 p-relative">
                <div>
                    <h4 class="font-24 mb-3 text-center">Order #{{ $order->id }}</h4>
                </div>

                <div class="grid grid-collumns-cart-item align-center gap-30 bg-lightbrown p-2 font-20 font-12-md font-11-sm">
                    <div class="text-center">
                        <b>Image</b>
                    </div>
                    <div class="text-center">
                        <b>Product</b>
                    </div>
                    <div class="text-center">
                        <b>Price</b>
                    </div>
                    <div class="text-center">
                        <b>quantity</b>
                    </div>
                    <div class="text-center">
                        <b>Total</b>
                    </div>
                    <div class="grid place-center">
                        <img width="30" src="{{ asset('image/eyedis.png') }}" alt="trash-can">
                    </div>
                </div>
                @foreach ($order->orderProducts as $product)
                    <div wire:key="{{ $product->id }}"
                        class="grid grid-collumns-cart-item align-center gap-30 mt-3 mb-3 p-2 bg-lightbrown font-12-md font-11-sm">
                        <div class="image-product-basket">
                            <a target="_blank" href="{{ route('product', $product->slug) }}">
                                <img src="{{ asset($product->image) }}" class="img-square-def">
                            </a>
                        </div>
                        <div class="text-center">
                            <a target="_blank" href="{{ route('product', $product->slug) }}">
                                <span class="font-20 text-black">
                                    {{ $product->title }}
                                </span>
                            </a>
                        </div>
                        <div class="text-center">
                            <span class="font-20">
                                ${{ $product->price }}
                            </span>
                        </div>
                        <div class="text-center">
                            <span class="font-20">
                                {{ $product->quantity }}
                            </span>
                        </div>
                        <div class="text-center">
                            <span class="font-24">
                                ${{ $product->price * $product->quantity }}
                            </span>
                        </div>
                        <div class="image-product-basket">
                            <a target="_blank" href="{{ route('product', $product->slug) }}">
                                <img width="40" src="{{ asset('image/eyeact.png') }}">
                            </a>
                        </div>
                    </div>
                @endforeach
                <div class="grid grid-collumns-2-auto gap-50">
                        <span class="">
                    @if ($order->note)
                            Note: {{ $order->note }}
                    @endif
                        </span>
                   
                    <span class="font-24 justify-self-right">
                        <b>Total: {{ \Illuminate\Support\Number::currency($order->total, in: 'USD', precision: 0) }}</b>
                    </span>
                </div>
            </div>
        </div>

    </section>
</div>