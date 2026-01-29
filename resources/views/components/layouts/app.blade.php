<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="{{ asset('image/favicon.png') }}">

    @section('metatags')
        <title>{{ config('app.name') . ' :: ' . ($title ?? 'Great purse') }}</title>
        <meta name="description" content="{{ $desc ?? '' }}">
    @show

    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/grid.css') }}">
    <link rel="stylesheet" href="{{ asset('libs/toastr/toastr.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/toastr.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <link rel="stylesheet" href="{{ asset('css/category.css') }}">
    <link rel="stylesheet" href="{{ asset('css/product.css') }}">
    <link rel="stylesheet" href="{{ asset('css/product-modal.css') }}">
    <link rel="stylesheet" href="{{ asset('css/cart.css') }}">
    <link rel="stylesheet" href="{{ asset('css/account.css') }}">
    <link rel="stylesheet" href="{{ asset('css/pagination.css') }}">
    <link rel="stylesheet" href="{{ asset('css/flash-message.css') }}">
    <link rel="stylesheet" href="{{ asset('css/double-range.css') }}">
    <link rel="stylesheet" href="{{ asset('css/media.css') }}">

    <script src="{{ asset('libs/jquery/jquery-3.7.1.js') }}" defer></script>
    <script src="{{ asset('libs/toastr/toastr.min.js') }}" defer></script>
    <script src="{{ asset('js/menu.js') }}" defer></script>
    <script src="{{ asset('js/gallery.js') }}" defer></script>
    <script src="{{ asset('js/flash.js') }}" defer></script>
    <script src="{{ asset('js/main.js') }}" defer></script>

    {{--
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO"
        crossorigin="anonymous"></script> --}}


</head>

<body>
    <div class="wrapper">
        <header>
            <div class="shadow" id="shadow2"></div>
            <div class="shadow" id="shadow3" style="z-index: 12"></div>
            <div class="container grid grid-columns-header coll-1-sm gap-20 gap-0-sm align-center">
                <div class="d-block d-none-sm">
                    <a wire:navigate href="{{ route('home') }}">
                        <img src="{{ asset('image/logo.png') }}" height="70" alt="logo">
                    </a>
                </div>
                <div class="justify-self-left justify-self-center-sm font-20-sm grid-area-5-sm mt-2-sm">
                    <nav class="mr-0-sm">
                        <ul>
                            <li class="d-inline-block d-none-sm"><a wire:navigate href="{{ route('home') }}">Home</a>
                            </li>
                            <li class="p-relative menu mt-2-sm">
                                <a class="c-pointer mr-0-sm font-20-sm text-brown" id="catalog">
                                    Catalog
                                </a>
                                <ul class="none-d p-absolute catalog">
                                    {!! \App\Helpers\Category\Category::getMenu('incs.menu-tpl', 'categories_html') !!}
                                </ul>
                            </li>
                        </ul>
                    </nav>
                </div>
                <div class="d-content d-content-md d-none-sm lead-hidden-menu mt-3-sm">
                    <div class="grid-area-4-sm mt-2-sm">
                        <livewire:search.search-form-component />
                    </div>
                    <div class="none-d d-block-sm wish-button mt-3-sm">
                        <livewire:wish.wish-icon-component />
                    </div>
                    <div class="grid-area-2-sm mt-2-sm">
                        <livewire:user.nav-component />
                    </div>
                    <div class="font-20-sm none-d d-block-sm grid-area-3-sm mt-3-sm">
                        <nav class="text-align-sm mr-0-sm">
                            <ul>
                                <li class="mr-0-sm"><a class="mr-0-sm" wire:navigate
                                        href="{{ route('home') }}">Home</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <div class="grid grid-collumns-2 coll-3-sm align-center justify-between-sm grid-area-1-sm">
                    <div class="d-none-sm wish-button">
                        <livewire:wish.wish-icon-component />
                    </div>
                    <div class="none-d d-block-sm">
                        <button id="show-menu">
                            <img src="{{ asset('image/toggle.png') }}" width="30" alt="">
                            <img src="{{ asset('image/toggle.png') }}" width="30" alt="">
                            <img src="{{ asset('image/toggle.png') }}" width="30" alt="">
                        </button>
                    </div>
                    <div class="none-d d-grid-sm justify-center-g">
                        <a wire:navigate href="{{ route('home') }}">
                            <img src="{{ asset('image/logo.png') }}" height="50" alt="logo">
                        </a>
                    </div>
                    <livewire:cart.cart-icon-component />
                </div>

            </div>
        </header>
        <main>
            {{ $slot }}
        </main>
        <footer>
            footer
        </footer>
    </div>
    <livewire:cart.cart-modal-component />
    <livewire:wish.wish-modal-component />
    <div class="shadow" id="shadow"></div>
    <button id="top">UP</button>
</body>

</html>
