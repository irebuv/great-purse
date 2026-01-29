<div class="row">
    <div class="col-xl-8 col-lg-12 offset-xl-2 offset-lg-0 mb-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    <a wire:navigate href="{{ route('admin.filters.create') }}" class="btn btn-primary">
                        Add filter group
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
                            <tr>
                                <th style="width: 5%" class="text-center">ID</th>
                                <th style="width: 25%">Title</th>
                                <th style="width: 50%">Filters</th>
                                <th style="width: 20%" class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($filter_groups as $filter_group)
                                <tr wire:key="{{ $filter_group->id }}">
                                    <td class="text-center">{{ $filter_group->id }}</td>
                                    <td>
                                        {{ $filter_group->title }}
                                    </td>
                                    <td class="pl-4">
                                        @foreach ($filter_group->filters as $filter)
                                        <div class="d-flex align-items-center">
                                            - {{ $filter->title }}  
                                            @if ($filter->visible == 0)
                                                <span class="text-warning"> (unvisible) </span>
                                            @endif 
                                            @if (count($filter_group->filters) > 1)
                                            <button wire:click="removeFilter({{ $filter->id }})" 
                                            wire:loading.attr="disabled" wire:target="removeFilter"
                                             class="btn-without-style ml-2 btn-with-image btn-delete"></button><br>
                                                @else
                                                <span class="text-danger">(At least one filter must be!)</span>
                                            @endif
                                        </div>
                                        @endforeach
                                    </td>
                                    <td class="text-center">
                                        <a wire:navigate href="{{ route('admin.filters.edit', $filter_group->id) }}"
                                            class="btn btn-warning btn-circle">
                                            <i class="fa fa-pen"></i>
                                        </a>
                                        <button wire:click="deleteFilterGroup({{ $filter_group->id }})"
                                            wire:confirm="Are you sure?" wire:loading.atrr="disabled"
                                            class="btn btn-danger btn-circle">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    </td>{{ $filter_groups->links() }}
                </div>

            </div>
        </div>
    </div>
</div>