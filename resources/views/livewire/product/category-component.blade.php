<div>

    @section('metatags')
        <title>{{ config('app.name') . ' :: ' . $title ?? 'Great purse' }}</title>
        <meta name="description" content="{{ $desc ?? '' }}">
    @endsection
    <section class="grid grid-collumns-category collumn-gap-50 mt-3">
        <div class="filter">
            <div>
                <h4 class="font-24">Filter by</h4>
                <hr class="mt-3 mb-3">
                <div>
                    <div class="grid grid-collumns-2-fr-auto justify-right align-center">
                        <div class="font-20">Price</div>
                        <div class="font-32">+</div>
                    </div>
                    <div class="double-slider mb-4 mt-2 p-relative">
                        <input wire:model.live.debounce.500ms="min_price" class="range-input" type="range"
                            id="slider-min" min="{{ $min_range }}" max="{{ $max_range }}" value="{{ $min_price }}">
                        <input wire:model.live.debounce.500ms="max_price" class="range-input2" type="range"
                            id="slider-max" min="{{ $min_range }}" max="{{ $max_range }}" value="{{ $max_price }}">
                    </div>
                    <div class="grid grid-collumns-3-auto price-filter justify-between-g align-center mt-3">
                        <input wire:model.live.debounce.500ms="min_price" class="input-def" type="number"
                            value="{{ $min_price }}">
                        <p>-</p>
                        <input wire:model.live.debounce.500ms="max_price" class="input-def" type="number"
                            value="{{ $max_price }}">
                    </div>
                </div>

                @foreach ($filter_groups as $k => $filter_group)
                    <hr class="mt-3 mb-3">
                    <div wire:key="{{ $k }}">
                        <div class="grid grid-collumns-2-fr-auto justify-right align-center">
                            <div class="font-20">{{ $filter_group[0]->title }}</div>
                            <div class="font-32">+</div>
                        </div>
                        @foreach ($filter_group as $filter)
                            <div wire:key="{{ $filter->filter_id }}"
                                class="grid grid-collumns-2-max-content align-center mt-2 current-filter">
                                <input wire:model.live="selected_filters" type="checkbox" id="filter-{{ $filter->filter_id }}"
                                    value="{{ $filter->filter_id }}">
                                <label class="ml-2 font-16" for="filter-{{ $filter->filter_id }}">
                                    {{ $filter->filter_title }}
                                </label>
                            </div>
                        @endforeach

                    </div>

                @endforeach
            </div>
        </div>
        <div>
            <div class="grid grid-collumns-3 mb-3 align-center">
                <div class="p-3 mr-3 justify-self-left bg-lightbrown">
                    <a wire:navigate href="{{ route('home') }}"><span class="text-brown">Home</span> /</a>
                    @foreach ($breadcrumbs as $breadcrumb_slug => $breadcrumb_title)
                        @if ($loop->last)
                            <span>{{ $breadcrumb_title }}</span>
                        @else
                            <a wire:navigate href="{{ route('category', $breadcrumb_slug) }}"><span
                                    class="text-brown">{{ $breadcrumb_title }}</span> /</a>
                        @endif
                    @endforeach
                </div>
                <h3 class="font-24 font-32" id="products">{{ $category->title }}</h3>
                <div></div>
            </div>
            <div class="grid grid-collumns-3-auto-1fr justify-right">
                <div class=" justify-self-left grid">
                    @if ($selected_filters)
                        <div class="grid grid-collumns-2-auto align-center bg-lightbrown p-2 mr-3 row-gap">
                            <button wire:click="clearFilters">Clear all filters</button>
                            <div>
                                @foreach ($filter_groups as $filter_group)
                                    @foreach ($filter_group as $filter)
                                        @if (in_array($filter->filter_id, $selected_filters))
                                            <div class="d-inline-block p-1">
                                                <div class="ml-4 remove-filter align-center">
                                                    <p wire:click="removeFilter({{ $filter->filter_id }})"
                                                        wire:key="{{ $filter->filter_id }}">{{ $filter->filter_title }}</p>
                                                    <button wire:click="removeFilter({{ $filter->filter_id }})"
                                                        wire:key="{{ $filter->filter_id }}"
                                                        class="btn-without-style font-24 justify-self-right close btn-with-image ml-2"></button>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
                <div class="mr-3 sort-by grid align-center grid-collumns-2-auto sort-by">
                    <div class="d-inline bg-gray p-2">Sort By:</div>
                    <select class="p-2 bg-lightbrown" name="Default" wire:change="changeSort" wire:model="sort">
                        @foreach ($sortList as $k => $item)
                            <option wire:key="{{ $k }}" value="{{ $k }}" @if ($k == $sort) selected @endif>
                                {{ $item['title'] }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="ml-4 sort-by grid align-center grid-collumns-2-auto sort-by">
                    <div class="d-inline bg-gray p-2">Show:</div>
                    <select wire:change="changeLimit" wire:model="limit" class="p-2 bg-lightbrown" name="9">
                        @foreach ($limitList as $item)
                            <option wire:key={{ $item }} value="{{ $item }}" @if ($k == $limit) selected @endif>
                                {{ $item }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            @if (count($products))
                <div class="grid grid-collumns-5 gap-30 category mt-3 p-relative">
                   @php
                      $act_wish = \App\Helpers\Wish\Wish::activeWishProduct()
                   @endphp
                    @foreach ($products as $product)
                        <div wire:key="{{ $product->id }}" class="h-100">
                            @include('incs.product-card', $act_wish)
                        </div>
                    @endforeach
                </div>
                <div class="mt-4">
                    {{ $products->links(data: ['scrollTo' => '#products']) }}
                </div>
            @else
                <p class="text-center mt-4 font-48">No products found...</p>
            @endif

        </div>
    </section>
</div>

@script
<script>
    $wire.on('page-updated', data => {
        document.title = data.title;
    });
</script>
@endscript