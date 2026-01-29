<div>
    <div wire:ignore.self class="add-comment none-d">
        <button class="btn-without-style font-24 justify-self-right close btn-with-image"></button>
        <div class="p-4 mt-3">
            <h3 class="font-32">Write a review</h3>

            <form wire:submit="saveReview" class="commet-form auth-form">
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
                            <span>Publish</span>
                            <span wire:loading class="rotate rotate2"> </span>
                        </div>
                    </button>
                </div>
            </form>
        </div>
    </div>
    <div class="make-comment grid grid-collumns-2 mb-4 p-2 align-center">
        <div>
            <b>Leave your feedback here:</b>
        </div>
        <div class="justify-self-right">
            <button class="font-18" id="review-add">Write a review</button>
        </div>
    </div>
    @if (count($comments))
        @foreach ($comments as $comment)
            <div class="comment-block mb-3">
                <div class="grid align-center p-2">
                    <div class="font-20">
                        <b>{{ $comment->name }}</b> 
                        @auth
                        @if (auth()->user()->is_admin && $comment->user_id != null) 
                        <span class="font-8">({{ $comment->user->name }})</span>
                         @endif
                        @endauth
                    </div>
                    <div class="ml-3">
                        <div class="p-relative stars-range ml-2 mr-1">
                            <div></div>
                            <div style="width: {{ $comment->evaluation * 20 }}%;"></div>
                        </div>
                    </div>
                    <div class="justify-self-right">
                        @auth
                        @if (auth()->user()->id == $comment->user_id || auth()->user()->is_admin)
                        <a wire:navigate href="{{ route('review.edit', $comment->id) }}" class="btn-without-style">
                            <img height="25" src="{{ asset('image/pen.png') }}" alt="">
                        </a>
                        <button wire:click="removeReview({{ $comment->id }})" wire:loading.attr="disabled" class="btn-without-style">
                            <img height="25" src="{{ asset('image/trash-can.png') }}" alt="">
                        </button>
                        @endif
                        @endauth
                    </div>
                    <div class="ml-3">
                        {{ $comment->updated_at }}
                    </div>
                </div>
                <div class="p-3">
                    <div class="mb-2">
                        <b>Pros:</b> {{ $comment->pros }}
                    </div>
                    <div class="mb-2">
                        <b>Cons:</b> {{ $comment->cons }}
                    </div>
                    <div>
                        {{ $comment->content }}
                    </div>
                </div>
            </div>
        @endforeach
    @else
        <p class="text-center font-24 mt-3 mb-3">There's no reviews yet...</p>
    @endif

    {{ $comments->links(data: ['scrollTo' => '#descriptions']) }}
</div>