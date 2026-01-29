<div class="row">
    <div class="col-xl-8 col-lg-12 offset-xl-2 offset-lg-0 mb-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    Orders list
                </h6>
            </div>
            <div class="card-body">
                <div wire:loading class="loader">
                    <div class="rotate"></div>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover" id="products">
                        <thead>
                            <tr>
                                <th style="width: 5%" class="text-center">ID</th>
                                <th>Email</th>
                                <th>Total</th>
                                <th>Created</th>
                                <th>Updated</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Change <br> status</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($this->orders() as $order)
                                <tr wire:key="{{ $order->id }}">
                                    <td class="text-center">{{ $order->id }}</td>
                                    <td>{{ $order->email }}</td>
                                    <td>${{ $order->total }}</td>
                                    <td>{{ $order->created_at }}</td>
                                    <td>{{ $order->updated_at }}</td>
                                    <td class="text-center">
                                        @if ($order->status)
                                            <span class="text-success">Completed</span>
                                        @else
                                            <span class="text-warning">New</span>
                                        @endif
                                    </td>
                                    <td class="text-center">

                                        <div class="filter-checks">
                                            <input wire:model="statuses" value="{{ $order->id }}"
                                                id="order-{{ $order->id }}" type="checkbox" class="demo1">
                                            <label wire:click="changeStatus({{ $order->id }})"
                                                for="order-{{ $order->id }}" class="form-check-label" data-on-label="DONE"
                                                data-off-label="NEW"></label>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <a wire:navigate href="{{ route('admin.orders.edit', $order->id) }}"
                                            class="btn btn-warning btn-circle">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        <button wire:click="deleteOrder({{ $order->id }})" wire:confirm="Are you sure?"
                                            wire:loading.atrr="disabled" class="btn btn-danger btn-circle">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $this->orders()->links() }}
                    </td>
                </div>

            </div>
        </div>
    </div>
</div>
@script
<script>
    $wire.dispatch('status-changed');
</script>
@endscript