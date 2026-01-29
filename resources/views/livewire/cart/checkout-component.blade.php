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
            <a wire:navigate href="{{ route('cart') }}">
                <span class="text-brown">Cart</span> /
            </a>
            <span>Checkout</span>
        </div>
        <div class="mt-3 grid grid-collumns-checkout gap-20">
            <div class="bg-lightbrown p-3 p-relative">
                @if ($cart = \App\Helpers\Cart\Cart::getCart())
                <h3 class="font-24">Checkout</h3>
                <form wire:submit="saveOrder" class="auth-form">
                    @guest
                    <div class="mt-3">
                        <label class="font-20 text-brown" for="name">Name:</label> <br>
                        <input wire:model="name" class="@error('name') error-input @enderror input-def mt-1" type="text"
                            id="name" placeholder="Write your name here..." required> <br>
                        @error('name')
                            <span class="text-error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mt-4">
                        <label class="font-20 text-brown" for="email">Email:</label> <br>
                        <input wire:model="email" class="@error('email') error-input @enderror input-def mt-1"
                            type="email" id="email" placeholder="Write your email here..." required><br>
                        @error('email')
                            <span class="text-error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mt-4">
                        <label class="font-20 text-brown" for="number">Number:</label> <br>
                        <input wire:model="number" class="@error('number') error-input @enderror input-def mt-1"
                            type="text" id="number" placeholder="Write your phone number here..." required><br>
                        @error('number')
                            <span class="text-error">{{ $message }}</span>
                        @enderror
                    </div>
                    @endguest

                    <div class="mt-4">
                        <label class="font-20 text-brown" for="note">Comment (optional):</label> <br>
                        <textarea wire:model="note" class="@error('note') error-input @enderror input-def mt-1"
                                        id="note" placeholder="Write your comment here..."></textarea><br>
                                    @error('note')
                                        <span class="text-error">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div>

                                    <button wire:loading.attr="disabled" wire:target="saveOrder" class="btn-def btn-brown mt-4 mb-2"
                                        type="submit">
                                        <div class="grid align-center grid-collumns-2-auto">
                                            <span>Checkout</span>
                                            <div wire:loading class="rotate rotate2"> </div>
                                        </div>
                                    </button>
                                </div>
                            </form>
                        @else
                <div class="grid place-center w-100 h-100">
                    <span class="font-32">Your cart is empty! Please add some items...</span>
                </div>
                @endif

            </div>
            <div class="bg-lightbrown p-3 align-self-start">
                <h3 class="font-24">Cart summary</h3>
                @if ($cart)
                    <div class="grid grid-collumns-2 mt-3 font-20">
                        <span><b>Product:</b></span>
                    </div>
                    <hr class="mb-3 mt-3">
                    @foreach ($cart as $k => $item)
                        <div wire:key="{{ $k }}">
                            <div class="grid grid-collumns-2-31 text-brown mt-2 mb-2 font-20">
                                <span>{{ $item['title'] }}</span>
                                <span class="text-right"><b>{{ $item['quantity']}} x {{ $item['price'] }}</b></span>
                            </div>
                        </div>
                    @endforeach
                    <hr class="mb-3 mt-3">
                @endif
                <div class="grid grid-collumns-2 mt-3 font-24">
                    <span><b>Total:</b></span>
                    <span class="text-right">
                        <b>{{ \Illuminate\Support\Number::currency(App\Helpers\Cart\Cart::getCartTotalSum(), in: 'USD', precision: 0) }}</b>
                    </span>
                </div>
            </div>
        </div>
    </section>
</div>