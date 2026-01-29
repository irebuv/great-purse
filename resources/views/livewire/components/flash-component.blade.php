<div class="flash-container">
    @if (session('success'))
        <div class="message message-success form-mes">
            <button class="btn-without-style justify-self-right close close-flash-msg btn-with-image close-flash"></button>
            <p>
                {{ session('success') }}
            </p>
        </div>
    @elseif (session('errors'))
        <div class="message message-error form-mes">
            <button class="btn-without-style justify-self-right close close-flash-msg btn-with-image close-flash"></button>
            @foreach ($errors->all() as $error)
                <p>
                    {{ $error }}
                </p>
            @endforeach
        </div>
    @elseif (session('warning'))
        <div class="message message-warning form-mes">
            <button class="btn-without-style justify-self-right close close-flash-msg btn-with-image close-flash"></button>
            <p>
                {{ session('warning') }}
            </p>
        </div>
    @endif
</div>