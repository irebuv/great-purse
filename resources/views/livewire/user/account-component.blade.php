<div>
    @section('metatags')
        <title>{{ config('app.name') . ' :: ' . $title ?? 'Great purse' }}</title>
        <meta name="description" content="{{ $desc ?? '' }}">
    @endsection
    <section class="container w-100-sm mt-3 pd-l-r-0 p-0-sm">
        <h2 class="font-48 mt-3 mb-4 text-brown">Welcome, {{ auth()->user()->name }}!</h2>
        <div class="p-3 justify-self-left bg-lightbrown">
            <a wire:navigate href="{{ route('home') }}">
                <span class="text-brown">Home</span> /
            </a>
            <span>Account</span>
        </div>
        <div class="mt-3 grid grid-collumns-2-13 coll-12-md coll-1-sm gap-20 account-posibilities">
            <div wire:ignore class="bg-lightbrown p-3 p-relative font-24 text-brown align-self-start">
                <ul>
                    <li id="account-btn-3" class="mt-2 mb-2 ml-3 active">Orders</li>
                    <li id="account-btn-1" class="mt-2 mb-2 ml-3">Account</li>
                    <li id="account-btn-2" class="mt-2 mb-2 ml-3">Change your information</li>
                </ul>
            </div>
            <div wire:ignore class="bg-lightbrown p-3 p-2-md p-relative">
                <div id="account-show-3" class="">
                    <h4 class="font-24 mb-3 text-center">Orders</h4>

                    @if ($orders->isNotEmpty())
                        <div wire:loading class="loader loader-cart">
                            <div class="rotate mt-4"></div>
                        </div>
                        <div class="grid grid-collumns-account align-center gap-30 bg-lightbrown p-2 p-1-md font-20 font-12-md font-11-sm">
                            <div class="text-center">
                                <b>#</b>
                            </div>
                            <div class="text-center">
                                <b>Total</b>
                            </div>
                            <div class="text-center">
                                <b>Status</b>
                            </div>
                            <div class="text-center">
                                <b>Created</b>
                            </div>
                            <div class="text-center">
                                <b>Updated</b>
                            </div>
                            <div class="grid place-center">
                                <img width="30" src="{{ asset('image/eyedis.png') }}" alt="trash-can">
                            </div>
                        </div>
                        @foreach ($orders as $order)
                            <div wire:key="{{ $order->id }}"
                                class="grid grid-collumns-account align-center gap-30 mt-3 mb-3 p-2 p-1-md bg-lightbrown font-12-md font-11-sm">
                                <div class="text-center">
                                    <span class="font-20">
                                        #{{ $order->id }}
                                    </span>
                                </div>
                                <div class="text-center">
                                    <span class="font-20">
                                        ${{ $order->total }}
                                    </span>
                                </div>
                                <div class="text-center">
                                    <span class="font-20">
                                        {{ $order->status ? 'Completed' : 'New' }}
                                    </span>
                                </div>
                                <div class="text-center">
                                    <span class="font-20">
                                        {{ $order->created_at }}
                                    </span>
                                </div>
                                <div class="text-center">
                                    <span class="font-20">
                                        {{ $order->updated_at }}
                                    </span>
                                </div>
                                <div class="image-product-basket">
                                    <a wire:navigate href="{{ route('order-show', $order->id) }}">
                                        <img width="40" src="{{ asset('image/eyeact.png') }}">
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <p class="mt-3">No orders yet...</p>
                    @endif
                </div>
                <div id="account-show-1" class="none-d"> 
                    <h4 class="font-24 text-center">Some information</h4>
                    <p class="mt-3">
                        You can see some information about your account here!
                    </p>
                </div>
                <div id="account-show-2" class="none-d">
                    <h4 class="font-24 mb-3 text-center">Change account</h4>

                    <form wire:submit="change" class="auth-form">
                        <div class="mt-3">
                            <label class="font-20 text-brown" for="name">Name:</label> <br>
                            <input wire:model="name" class="@error('name') error-input @enderror input-def mt-1"
                                type="text" id="name" placeholder="Write your name here..." required> <br>
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
                        <div class="mt-4">
                            <label class="font-20 text-brown" for="password">Password:</label> <br>
                            <input wire:model="password" class="@error('password') error-input @enderror input-def mt-1"
                                type="password" id="password" placeholder="Write your password here..."><br>
                            @error('password')
                                <span class="text-error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <button wire:loading.attr="disabled" wire:target="save" class="btn-def btn-brown mt-4 mb-2">
                                <div class="grid align-center grid-collumns-2-auto">
                                    <span>Change</span>
                                    <span wire:loading class="rotate rotate2"> </span>
                                </div>
                            </button>
                        </div>
                    </form>
                </div>
                
            </div>
        </div>
        
    </section>
</div>