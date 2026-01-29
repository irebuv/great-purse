<div class="font-20 p-relative coll-1-sm justify-center-sm text-align-sm">
    @guest
        <div class="mt-1-sm">
            <a wire:navigate class="text-brown" href="{{ route(name: 'login') }}">Log In</a>
            <a wire:navigate class="text-brown ml-2" href="{{ route('register') }}">Sign Up</a>
        </div>
    @endguest
    @auth
        <div class="grid align-center grid-collumns-3-auto coll-1-sm justify-center-sm text-align-sm font-20-sm">
            @if (auth()->user()->is_admin)
                <a class="text-brown c-pointer mt-1-sm" href="{{ route('admin') }}">Admin</a>
            @endif
            <a wire:navigate class="text-brown ml-2 grid-area-1-sm ml-0-sm mt-1-sm" href="{{ route('account') }}">
                <img height="40px" src="{{ asset('image/account.png') }}" alt="Account">
            </a>
            <a class="text-brown ml-2 ml-0-sm mt-1-sm" href="{{ route('logout') }}">Log Out</a>
        </div>

    @endauth
    <livewire:components.flash-component />
</div>