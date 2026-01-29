<div class="row">
    <div class="col-xl-10 col-lg-12 offset-xl-1 offset-lg-0 mb-4">
        <div class="card shadow mb-4 p-relative">
            <div wire:loading wire:target="save" class="loader">
                <div class="rotate"></div>
            </div>
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    <a wire:navigate href="{{ route('admin.products.index') }}" class="btn btn-primary">
                        Products List
                    </a>
                </h6>
            </div>
            <div class="card-body">
                <form wire:submit="save">

                    <div class="mt-4">
                        <label class="form-label required" for="title">Title:</label> <br>
                        <input wire:model="title" class="@error('title') is-invalid @enderror form-control" type="text"
                            id="title" placeholder="Title Product...">
                        @error('title')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mt-4">
                        <label class="form-label required" for="category_id">Category:</label> <br>
                        <select wire:model.live="category_id" id="category_id"
                            class="custom-select @error('category_id') is-invalid @enderror">
                            <option value="">Select category</option>
                            {!! \App\Helpers\Category\Category::getMenu('incs.menu-select-tpl') !!}
                        </select>
                        @error('category_id')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div class="row">
                        @foreach ($this->filters() as $k => $filter_group)
                            <div class="col-lg-4 col-md-12 mt-2" wire:key="{{ $k }}">
                                <div class="card">
                                    <div class="card-header">
                                        <h6 class="font-weight-bold text-primary">{{ $filter_group[0]->title }}</h6>
                                    </div>
                                    <div class="card-body filter-title mt-3">
                                        @foreach ($filter_group as $filter)
                                            <div class="filter-checks mt-2" wire:key="{{ $filter->filter_id }}">
                                                <input wire:model="selectedFilters" value="{{ $filter->filter_id }}"
                                                    id="filter-{{ $filter->filter_id }}" type="checkbox" class="demo1">
                                                <label for="filter-{{ $filter->filter_id }}" class="form-check-label"
                                                    data-on-label="ON" data-off-label="OFF"></label>
                                            </div>
                                            <div class="text-center mt-1">
                                                {{ $filter->filter_title }}
                                            </div>
                                            @if ($filter->filter_visible == 0)
                                                <div class="text-center mt-n2">
                                                    <span class="text-danger">(This filter unvisible)</span>
                                                </div>
                                            @endif
                                            <hr>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-4">
                        <label class="form-label required" for="price">Price:</label> <br>
                        <input wire:model="price" class="@error('price') is-invalid @enderror form-control"
                            type="number" id="price" placeholder="Price...">
                        @error('price')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mt-4">
                        <label class="form-label" for="old_price">Old price:</label> <br>
                        <input wire:model="old_price" class="@error('old_price') is-invalid @enderror form-control"
                            type="number" id="old_price" placeholder="Product old price...">
                        @error('old_price')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="row mt-4 ml-2">
                        <div class="col-auto">
                            <input wire:model="is_hit" class="@error('is_hit') is-invalid @enderror" type="checkbox"
                                id="is_hit">
                            <label class="form-check-label" for="is_hit">Is hit?</label>
                            @error('is_hit')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-auto ml-4">
                            <input wire:model="is_new" class="@error('is_new') is-invalid @enderror" type="checkbox"
                                id="is_new">
                            <label class="form-check-label" for="is_new">Is new?</label>
                            @error('is_new')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="mt-4">
                        <label class="form-label" for="excerpt">Excerpt:</label> <br>
                        <input wire:model="excerpt" class="@error('excerpt') is-invalid @enderror form-control"
                            type="text" id="excerpt" placeholder="Excerpt Product...">
                        @error('excerpt')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mt-4">
                        <livewire:admin.file-manager.file-manager-component />
                        <label class="form-label required" for="summernote">Content:</label> <br>
                        <div class="@error('content') error-block @enderror">
                            <div wire:ignore>
                                <textarea wire:model="content" class=" form-control"
                                    type="text" id="summernote"></textarea>
                            </div>
                        </div>
                        @error('content')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>


                    <div class="row p-3 gap-30">
                        <div class="mt-4 col-lg-12 col-xl-4 offset-xl-1 image-create p-3">
                                    <div wire:loading wire:target="image" class="loader loader-small">
                                        <div class="rotate"></div>
                                    </div>
                            <label class="form-label" for="image">Image:</label>
                            @if ($photo)
                                <img class="my-1" src="{{ asset($photo) }}" alt="" height="50">
                            @else
                                <img class="my-1" src="{{ asset('image/no-image.png') }}" alt="" height="50">
                            @endif
                            <input wire:model="image"
                                class="form-control w-auto my-2 c-pointer image-create-input @error('image') is-invalid @enderror" type="file"
                                id="image">
                            @error('image')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                            <div wire:loading wire:target="image">
                                <span class="text-success">Uploading...</span>
                            </div>
                            @if (!$errors->has('image') && $image && $image->isPreviewable())
                                <p class="text-warning">Click on the photo to delete it.</p>
                                <div class="p-5">
                                <img wire:click="removeUpload('image', '{{ $image->getFilename() }}')"
                                    src="{{ $image->temporaryUrl() }}" class="c-pointer img-square-def">
                                </div>
                            @endif
                        </div>

                        <div class="mt-4 col-lg-12 col-xl-4 p-3 offset-xl-1 image-create ">
                                    <div wire:loading wire:target="gallery" class="loader loader-small">
                                        <div class="rotate"></div>
                                    </div>
                            <label class="form-label" for="gallery">Gallery:</label>
                            @if ($photos)
                                <p class="text-warning">Click on the photo to delete it.</p>
                                @foreach ($photos as $k => $item)
                                    <img wire:click="deleteGalleryItem({{ $k }})" wire:key="{{ $k }}"
                                    src="{{ asset($item) }}" alt="" height="50">
                                @endforeach
                            @endif
                            <input wire:model="gallery" class="form-control w-auto c-pointer my-2 image-create-input
                            @error('gallery.*') is-invalid @enderror" type="file" id="gallery" multiple>
                            @error('gallery.*')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                            <div wire:loading wire:target="gallery">
                                <span class="text-success">Uploading...</span>
                            </div>
                            @if ($gallery)
                            <hr>
                                <div class="mt-2"> 
                                    <div class="row">
                                    @foreach ($gallery as $photo)
                                        @if ($photo->isPreviewable())
                                        <div class="col-4 p-2">
                                            <img wire:click="removeUpload('gallery', '{{ $photo->getFilename() }}')"
                                                src="{{ $photo->temporaryUrl() }}" class="c-pointer img-square-def">
                                        </div>
                                        @else
                                            <span class="text-danger">Error!</span>
                                        @endif
                                    @endforeach
                                </div></div>
                            @endif
                        </div>
                        
                    </div>



                    <div>
                        <button wire:loading.attr="disabled" class="btn btn-info mt-4 mb-2" type="submit">
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

@script
<script>

    $(function () {
        $('#summernote').summernote({
            callbacks: {
                onChange: function (contents, $editable) {
                    $wire.$set('content', contents, false)
                }
            },
            height: 500
        });
    });

</script>
@endscript