<div>

    @section('metatags')
        <title>{{ config('app.name') . ' :: ' . $title ?? 'Great purse' }}</title>
        <meta name="description" content="{{ $desc ?? '' }}">
    @endsection

    <section class="main-bg pb-3-md">
        <div>
            <div class="carousel">
                {{-- <img id="carousel2" src="image/storyBG.JPG" alt="bg2"> --}}
                <img id="carousel" src="{{ asset('image/back.JPG') }}" alt="bg">
            </div>
            <div class="grid place-center">
                <h1 class="font-96 text-white font-24-xs"><b>New wallets <br> collection</b></h1>
                <a href="#"><button class="font-24 btn-def btn-white">Shop now</button></a>
            </div>
        </div>
    </section>

    <section class="grid grid-collumns-2 coll-1-md collumn-gap-50 nav-block">
        <div>
            <img class="w-100" src="{{ asset('image/storyBg.JPG') }}" alt="our story">
            <a class="grid place-center" href="#">
                <h2 class="font-96 font-24-xs"><b>Our Story</b></h2>
            </a>
        </div>
        <div class="mt-3-md">
            <img class="w-100" src="{{ asset('image/about.JPG') }}" alt="our story">
            <a class="grid place-center" href="#">
                <h2 class="font-96 font-24-xs"><b>Our Story</b></h2>
            </a>
        </div>
    </section>
    @php
        $act_wish = \App\Helpers\Wish\Wish::activeWishProduct()
    @endphp
    @if ($hits_products->isNotEmpty())
        <section class="bg-gray p-t-b-4 pt-2-md mb-0">
            <h3 class="mt-3 mb-4 font-48 ">Featured Products</h3>
            <div class="grid grid-collumns-4 coll-3-lg coll-2-md coll-1-sm grid-rows gap-30">
                @foreach ($hits_products as $product)
                    <div wire:key="{{ $product->id }}">
                        @include('incs.product-card')
                    </div>
                @endforeach
            </div>
            <a href="#"><button class="btn-def btn-brown mt-4">show all...</button></a>
        </section>
    @endif

    @if ($new_products->isNotEmpty())
        <section class="bg-gray p-t-b-4 pt-2-md mb-0">
            <h3 class="mt-3 mb-4 font-48">New products</h3>
            <div class="grid grid-collumns-3 coll-3-lg coll-2-md coll-1-sm gap-30">
                @foreach ($new_products as $product)
                    <div wire:key="{{ $product->id }}">
                        @include('incs.product-card')
                    </div>
                @endforeach
            </div>
            <a href="#"><button class="btn-def btn-brown mt-4">show all...</button></a>
        </section>
    @endif

    <section class="grid grid-collumns-3 coll-1-sm collumn-gap-50 bg-gray pt-5 pt-0-md pd-l-r-0 text-uppercase">
        <a href="">
            <div class="new">
                <img src="{{ asset('image/new/1.jpg') }}">
                <div class="grid place-center font-32">
                    Tops
                </div>
            </div>
        </a>
        <a href="">
            <div class="new">
                <img src="{{ asset('image/new/2.jpg') }}">
                <div class="grid place-center font-32">
                    Accesories
                </div>
            </div>
        </a>
        <a href="">
            <div class="new">
                <img src="{{ asset('image/new/3.jpg') }}">
                <div class="grid place-center font-32">
                    Shoes
                </div>
            </div>
        </a>
    </section>

    <section class="grid grid-collumns-3 coll-1-sm collumn-gap-50 bg-gray pd-l-r-0 advantages">
        <div class="grid place-center font-20">
            <img class="justify-self-center" width="40" src="{{ asset('image/advantages/circleArrows.png') }}"
                alt="circle">
            <p class="mt-3">Free Shipping and Returns</p>
        </div>
        <div class="grid place-center font-20">
            <img class="justify-self-center" width="40" src="{{ asset('image/advantages/lock.png') }}" alt="lock">
            <p class="mt-3">Secured Payments</p>
        </div>
        <div class="grid place-center font-20">
            <img class="justify-self-center" width="40" src="{{ asset('image/advantages/umbrella.png') }}"
                alt="umbrella">
            <p class="mt-3">Customer Service</p>
        </div>
    </section>
</div>