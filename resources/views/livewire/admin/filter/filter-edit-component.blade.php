<div class="row">
    <div class="col-xl-4 col-lg-8 offset-xl-4 offset-lg-2 mb-4">
        <div class="card shadow mb-4 p-relative">
            <div wire:loading class="loader">
                <div class="rotate"></div>
            </div>
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    <a wire:navigate href="{{ route('admin.filters.index') }}" class="btn btn-primary">
                        Filters List
                    </a>
                </h6>
            </div>
            <div class="card-body">
                <form wire:submit.prevent="save" action="">

                    <div class="mt-4">
                        <label class="form-label required mb-0" for="title">Title Group filter:</label> <br>
                        <input wire:model="title" class="@error('title') is-invalid @enderror form-control" type="text"
                            id="title" placeholder="Title Group filter...">
                        @error('title')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="card mt-2">
                        <div class="card-body row">
                            @foreach ($this->filtersEdit() as $k => $filter)
                                <div class="col-4 mb-3">
                                    <div class="filter-checks mt-2" wire:key="{{ $filter->id }}">
                                        <input wire:model="filters" value="{{ $filter->id }}" id="filter-{{ $filter->id }}"
                                            type="checkbox" class="demo1">
                                        <label for="filter-{{ $filter->id }}" class="form-check-label" data-on-label="ON"
                                            data-off-label="OFF"></label>
                                    </div>
                                    <div class="mt-1">
                                        <input wire:model="filters_title.{{ $filter->id }}" class="text-center w-100 input-filters" type="text"
                                            value="{{ $filter->title }}">
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <label class="form-label mb-0 mt-3" for="add_filter">Add new filter:</label> <br>
                    <div class="input-group">
                        <input wire:model="add_filter"
                            class="@error('add_filter') is-invalid @enderror form-control w-auto c-pointer" type="text"
                            id="add_filter" placeholder="Add new filter to this group...">
                        <div class="input-group-append">
                            <a wire:click="addFilter" class="btn btn-primary">Add one more</a>
                        </div>
                        @error('add_filter')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <button class="btn btn-info mt-4 mb-2" type="submit">
                            <div class="d-flex align-items-center">
                                <span>Save</span>
                                <span wire:loading wire:target="save" class="spinner-grow spinner-grow-sm ml-2"
                                    role="status"></span>
                            </div>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>