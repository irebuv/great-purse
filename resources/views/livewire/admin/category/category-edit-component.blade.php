<div class="row">
    <div class="col-xl-4 col-lg-8 offset-xl-4 offset-lg-2 mb-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    <a wire:navigate href="{{ route('admin.categories.index') }}" class="btn btn-primary">
                        Category List
                    </a>
                </h6>
            </div>
            <div class="card-body">
                <form wire:submit="save">
                    <div class="mt-4">
                        <label class="form-label required" for="title">Title:</label> <br>
                        <input wire:model="title" class="@error('title') is-invalid @enderror form-control" type="text"
                            id="title" placeholder="Title Category...">
                        @error('title')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mt-4">
                        <label class="form-label required" for="parent_id">Parent category</label> <br>
                        <select wire:model="parent_id" id="parent_id"
                            class="custom-select @error('parent_id') is-invalid @enderror">
                            <option value="0" wire:key="0">Root category</option>
                            {!! \App\Helpers\Category\Category::getMenu('incs.menu-select-tpl') !!}
                        </select>
                        @error('parent_id')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3 mt-4">
                        <div class="card">
                            <div class="card-header">
                                Filters
                            </div>
                            <div class="card-body">
                                @foreach ($filter_groups as $filter_group)
                                    <div wire:key="{{ $filter_group->id }}" class="form-check">
                                        <input wire:model="selected_categories_filters" type="checkbox"
                                            class="form-check-input" value="{{ $filter_group->id }}"
                                            id="filter-{{ $filter_group->id }}">
                                        <label class="form-check-label" for="filter-{{ $filter_group->id }}">
                                            {{ $filter_group->title }}
                                        </label>
                                    </div>
                                @endforeach
                                @error('selected_categories_filters.*')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
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