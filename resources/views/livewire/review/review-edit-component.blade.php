<div>
    @section('metatags')
        <title>{{ config('app.name') . ' :: ' . $title ?? 'Great purse' }}</title>
        <meta name="description" content="{{ $desc ?? '' }}">
    @endsection
    @if (auth()->user()->is_admin || auth()->user()->id == $user)
        <section class="container mt-3 pd-l-r-0">
        <div class="p-3 justify-self-left bg-lightbrown">
            <a wire:navigate href="{{ route('home') }}">
                <span class="text-brown">Home</span> /
            </a>

            @foreach ($breadcrumbs as $breadcrumb_slug => $breadcrumb_title)
                <a wire:navigate href="{{ route('category', $breadcrumb_slug) }}">
                    <span class="text-brown">{{ $breadcrumb_title }}</span> /
                </a>
            @endforeach

            <a wire:navigate href="{{ route('product', $product->slug) }}">
                <span class="text-brown">{{ $product->title }}</span> /
            </a>
            <span>Review edit</span>
        </div>
        <div class="p-4 mt-3 bg-lightbrown">
            <h3 class="font-32">Review edit</h3>

            <form wire:submit="save" class="commet-form auth-form">
                <div class="mt-3 grid grid-collumns-2-max-content align-center">
                    <div class="text-brown">
                        Chose your raiting:
                    </div>
                    <div class="star-rating ml-1">
                        <input wire:model="evaluation" type="radio" id="evaluation-5" value="5" />
                        <label for="evaluation-5" title="5 stars"></label>
                        <input wire:model="evaluation" type="radio" id="evaluation-4" value="4" />
                        <label for="evaluation-4" title="4 stars"></label>
                        <input wire:model="evaluation" type="radio" id="evaluation-3" value="3" />
                        <label for="evaluation-3" title="3 stars"></label>
                        <input wire:model="evaluation" type="radio" id="evaluation-2" value="2" />
                        <label for="evaluation-2" title="2 stars"></label>
                        <input wire:model="evaluation" type="radio" id="evaluation-1" value="1" />
                        <label for="evaluation-1" title="1 star"></label>
                    </div>
                </div>
                <div class="mt-3">
                    <label class="font-20 text-brown" for="name">Name:</label> <br>
                    <input wire:model="name" class="@error('name') error-input @enderror input-def mt-1" type="text"
                        id="name" placeholder="Write your name here..." required> <br>
                    @error('name')
                        <span class="text-error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mt-4">
                    <label class="font-20 text-brown" for="pros">Pros:(optional)</label> <br>
                    <textarea wire:model="pros"
                        class="@error('pros') error-input @enderror input-def mt-1 small-textarea" type="pros" id="pros"
                        placeholder="Write your pros here..."></textarea><br>
                    @error('pros')
                        <span class="text-error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mt-4">
                    <label class="font-20 text-brown" for="cons">Cons:(optional)</label> <br>
                    <textarea wire:model="cons"
                        class="@error('cons') error-input @enderror input-def mt-1 small-textarea" type="text" id="cons"
                        placeholder="Write your cons here..."></textarea><br>
                    @error('cons')
                        <span class="text-error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mt-4">
                    <label class="font-20 text-brown" for="content">Content:</label> <br>
                    <textarea wire:model="content" class="@error('content') error-input @enderror input-def mt-1"
                        type="text" id="content" placeholder="Write your content here..." required></textarea><br>
                    @error('content')
                        <span class="text-error">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <button wire:loading.attr="disabled" wire:target="saveReview" type="submit"
                        class="btn-def btn-brown mt-4 mb-2">
                        <div class="grid align-center grid-collumns-2-auto">
                            <span>Change</span>
                            <span wire:loading class="rotate rotate2"> </span>
                        </div>
                    </button>
                </div>
            </form>
        </div>
    </section>
    @else
        @php
            abort(404)
        @endphp
    @endif
    
</div>