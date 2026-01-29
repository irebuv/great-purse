<div>
    @section('metatags')
        <title>{{ config('app.name') . ' :: ' . $title ?? 'Great purse' }}</title>
        <meta name="description" content="{{ $desc ?? '' }}">
    @endsection
    <section class="grid mt-3">
        <div class="grid grid-collumns-3 mb-3 align-center">
            <div class="p-3 mr-3 justify-self-left">
                <div class="p-3 justify-self-left bg-lightbrown">
                    <a wire:navigate href="{{ route('home') }}">
                        <span class="text-brown">Home</span> /
                    </a>
                    <span>Search</span>
                </div>
            </div>
            <h3 class="font-24 font-32" id="products">Searched products</h3>
            <div class=" justify-self-right mr-4">
                <span>Search by: <b>{{ $query }}</b></span>
            </div>
        </div>
        <div>
            @if (count($products))
                <div class="flex-collumns-search gap-30 category mt-3 p-relative">
                    <div wire:loading wire:target.except="add2Cart" class="loader">
                        <div class="rotate"></div>
                    </div>
                    @foreach ($products as $product)
                        <div wire:key="{{ $product->id }}" class="h-100">
                            @include('incs.product-card')
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-center mt-4 font-48">No products found...</p>
            @endif
            <div class="mt-4">
                {{ $products->links() }}
            </div>
    </section>
</div>
