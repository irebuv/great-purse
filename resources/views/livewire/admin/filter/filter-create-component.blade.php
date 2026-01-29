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
                <form wire:submit.prevent="save">

                    <div class="mt-4">
                        <label class="form-label required" for="title">Title Group filter:</label> <br>
                        <input wire:model="title" class="@error('title') is-invalid @enderror form-control" type="text"
                            id="title" placeholder="Title Group filter...">
                        @error('title')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <p class="mt-4 mb-0">Filter titles:</p>
                    @foreach ($this->filtersAdd() as $k => $filter)
                    <div class="mb-2">
                        <div class="input-group w-50">
                            <input wire:model.live.debounce.500="add_filters.{{ $k }}"
                                class="@error('add_filters') is-invalid @enderror form-control" type="text" id="add_filters">
                            @if ($k !== array_key_last($this->add_filters))
                                <div class="input-group-append">
                                    <a wire:click="removeFilter({{ $k }})" class="btn btn-primary">X</a>
                                </div>
                            @endif
                        </div>
                        @error('add_filters')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    @endforeach


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