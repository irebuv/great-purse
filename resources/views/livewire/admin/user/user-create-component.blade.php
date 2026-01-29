<div class="row">
    <div class="col-xl-4 col-lg-8 offset-xl-4 offset-lg-2 mb-4">
        <div class="card shadow mb-4 p-relative">
            <div wire:loading class="loader">
                <div class="rotate"></div>
            </div>
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    <a wire:navigate href="{{ route('admin.users.index') }}" class="btn btn-primary">
                        Users List
                    </a>
                </h6>
            </div>
            <div class="card-body">
                <form wire:submit.prevent="save">

                    <div class="mt-4">
                        <label class="form-label required" for="name">Name:</label> <br>
                        <input wire:model="name" class="@error('name') is-invalid @enderror form-control" type="text"
                            id="name" placeholder="Write user's name...">
                        @error('name')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mt-4">
                        <label class="form-label required" for="email">Email:</label> <br>
                        <input wire:model="email" class="@error('email') is-invalid @enderror form-control" type="email"
                            id="email" placeholder="Write user's email...">
                        @error('email')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mt-4">
                        <label class="form-label required" for="number">Number:</label> <br>
                        <input wire:model="number" class="@error('number') is-invalid @enderror form-control"
                            type="text" id="number" placeholder="Write user's number...">
                        @error('number')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mt-4">
                        <label class="form-label required" for="password">Password:</label> <br>
                        <input wire:model="password" class="@error('password') is-invalid @enderror form-control"
                            type="password" id="password" placeholder="Write user's password...">
                        @error('password')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <div class="filter-checks mt-4" style="justify-content: start;">
                            <span>Is admin?</span>
                            <input wire:model.live="is_admin" id="is_admin" type="checkbox" class="demo1">
                            <label for="is_admin" class="form-check-label" data-on-label="ON"
                                data-off-label="OFF"></label>
                            @if ($is_admin == true)
                            <span class="text-danger">(Be carefull when you make someone an admin!)</span>
                            @endif
                        </div>
                        <div class="mt-1">
                        </div>
                        @error('is_admin')
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