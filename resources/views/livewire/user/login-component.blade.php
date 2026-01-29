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
            <span>Login</span>
        </div>
        <div class="p-4 mt-3 bg-lightbrown">
            <h3 class="font-32">Login</h3>

            <form wire:submit="login" class="auth-form">
                <div class="mt-4">
                    <label class="font-20 text-brown" for="enter">Email or Login:</label> <br>
                    <input wire:model="enter" class="@error('enter') error-input @enderror input-def mt-1" type="text"
                        id="enter" placeholder="Write your email or login here..." required><br>
                    @error('enter')
                        <span class="text-error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mt-4">
                    <label class="font-20 text-brown" for="password">Password:</label> <br>
                    <input wire:model="password" class="@error('password') error-input @enderror input-def mt-1"
                        type="password" id="password" placeholder="Write your password here..." required><br>
                    @error('name')
                        <span class="text-error">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <button wire:loading.attr="disabled" wire:target="save" class="btn-def btn-brown mt-4 mb-2">
                        <div class="grid align-center grid-collumns-2-auto">
                            <span>Login</span>
                            <span wire:loading class="rotate rotate2"> </span>
                        </div>
                    </button>
                </div>
            </form>
        </div>
    </section>
</div>