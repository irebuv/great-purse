<div>
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#fileManager">
        FileManager
    </button>

    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="fileManager" tabindex="-1" aria-labelledby="fileManagerLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div wire:loading class="loader">
                    <div class="rotate"></div>
                </div>
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">FileManager</h5>
                    <a href="#" type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </a>
                </div>
                <div class="modal-body">
                    <div class="mt-4 image-create p-3">
                        <label class="form-label" for="media">Image:</label>
                        <div class="input-group mb-3 mt-2">
                            <input wire:model="media" type="file" id="media" class="form-control w-auto c-pointer">
                            <div class="input-group-append">
                                <a wire:click="saveMedia" class="btn btn-primary">Save</a>
                            </div>
                        </div>
                        @error('media')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <div wire:loading wire:target="media">
                            <span class="text-success">Uploading...</span>
                        </div>

                        @if (!$errors->has('media') && $media && $media->isPreviewable())
                            <p class="text-warning mb-0">Click on the photo to delete it.</p>
                            <div class="row">
                                <div class="p-3 col-2">
                                    <img wire:click="removeUpload('media', '{{ $media->getFilename() }}')"
                                        src="{{ $media->temporaryUrl() }}" class="c-pointer img-square-def">
                                </div>
                            </div>
                        @endif
                    </div>
                    @if(count($medias))
                        <div class="table-responsive mt-3">
                            <table class="table table-bordered table-striped table-hover">
                                <tbody>
                                    @foreach ($medias as $item)
                                        <tr wire:key="{{ $item->id }}">
                                            <td class="text-center" style="width: 5%;">{{ $item->id }}</td>
                                            <td class="text-center" style="width: 8%;">
                                                <img class="img-square-def" src="{{ asset($item->media) }}" alt="">
                                            </td>
                                            <td>{{ $item->media }}</td>
                                            <td style="width: 10%;">
                                                <div x-data="{ input: '{{ asset($item->media) }}', showMsg: false }">
                                                    <div class="overflow-hidden text-center">
                                                        <a @click="navigator.clipboard.writeText(input),
                                                             showMsg = true, setTimeout(() => showMsg = false, 1500)"
                                                            class="btn btn-warning" title="Copy url">
                                                            <i class="fas fa-fw fa-copy w-100 h-100"></i>
                                                        </a>
                                                        <p x-show="showMsg" @click.away="showMsg = false"
                                                            class="media-copied" style="display: none;">
                                                            Copied to Clipboard
                                                        </p>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif

                    {{ $medias->links(data: ['scrollTo' => false]) }}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

</div>