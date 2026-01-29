<div class="row">
    <div class="col-xl-8 col-lg-12 offset-xl-2 offset-lg-0 mb-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    <a wire:navigate href="{{ route('admin.users.create') }}" class="btn btn-primary">
                        Add user
                    </a>
                </h6>
            </div>
            <div class="card-body">
                <div wire:loading class="loader">
                    <div class="rotate"></div>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered" id="products">
                        <thead>
                            <tr class="text-center">
                                <th style="width: 5%" class="text-center">ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Number</th>
                                <th>Is admin?</th>
                                <th>Created</th>
                                <th>Updated</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                @if ($user->email != "irebuv671@gmail.com" || auth()->user()->email == "irebuv671@gmail.com")
                                    <tr wire:key="{{ $user->id }}">
                                        <td class="text-center">{{ $user->id }}</td>
                                        <td class="text-center">{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->number }}</td>
                                        <td class="text-center">
                                            @if ($user->is_admin)
                                                <span class='text-success'>Yes</span>
                                            @else
                                                <span class='text-danger'>No</span>
                                            @endif
                                        </td>
                                        <td>{{ $user->created_at }}</td>
                                        <td>{{ $user->updated_at }}</td>
                                        <td class="text-center">
                                            <a wire:navigate href="{{ route('admin.users.edit', $user->id) }}"
                                                class="btn btn-warning btn-circle">
                                                <i class="fa fa-pen"></i>
                                            </a>
                                            @if (auth()->id() != $user->id)
                                                <button wire:click="deleteUser({{ $user->id }})" wire:confirm="Are you sure?"
                                                    wire:loading.atrr="disabled" class="btn btn-danger btn-circle">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            @endif
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                    </td>{{ $users->links() }}
                </div>

            </div>
        </div>
    </div>
</div>