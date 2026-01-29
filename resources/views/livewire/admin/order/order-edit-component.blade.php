<div class="row">
    <div class="col-xl-8 col-lg-12 offset-xl-2 offset-lg-0 mb-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    <a wire:navigate href="{{ route('admin.orders.index') }}" class="btn btn-primary">
                        Orders list
                    </a>
                </h6>
            </div>
            <div class="card-body">
                <div wire:loading class="loader">
                    <div class="rotate"></div>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover" id="products">
                        <tbody>
                            <tr>
                                <th colspan="2">
                                     Order #{{ $order->id }} ({{ $order->status ? 'Completed' : 'New'}})
                                </th>
                            </tr>
                            <tr>
                                <th class="text-center">#</th>
                                <td class="text-center">{{ $order->id }}</td>
                            </tr>
                            <tr>
                                <th class="text-center">Customer name</th>
                                <td class="text-center">{{ $order->name }}</td>
                            </tr>
                            <tr>
                                <th class="text-center">Customer email</th>
                                <td class="text-center">{{ $order->email }}</td>
                            </tr>
                            <tr>
                                <th class="text-center">Status</th>
                                <td class="text-center">
                                    <div class="filter-checks">
                                        <input wire:model.live="status"
                                            id="order-{{ $order->id }}" type="checkbox" class="demo1">
                                        <label for="order-{{ $order->id }}" class="form-check-label" data-on-label="DONE"
                                            data-off-label="NEW"></label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th class="text-center">Total</th>
                                <td class="text-center">${{ $order->total }}</td>
                            </tr>
                            <tr>
                                <th class="text-center">Created</th>
                                <td class="text-center">{{ $order->created_at }}</td>
                            </tr>
                            <tr>
                                <th class="text-center">Updated</th>
                                <td class="text-center">{{ $order->updated_at }}</td>
                            </tr>
                            <tr>
                                <th class="text-center">Note</th>
                                <td class="text-center">{{ $order->note }}</td>
                            </tr>
                        </tbody>
                    </table>
                    </td>
                </div>

            </div>
        </div>

        
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    Order products
                </h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover" id="products">
                        <thead>
                            <tr>
                                <th style="width: 50px;" class="text-center">Image</th>
                                <th>Product</th>
                                <th>Price</th>
                                <th style="width: 50px;" class="text-center">Quantity</th>
                                <th style="width: 50px;" class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order->orderProducts as $product)
                                <tr wire:key="{{ $product->id }}">
                                    <td class="text-center">
                                        <img src="{{ asset($product->image) }}" alt="" height="50">
                                    </td>
                                    <td>{{ $product->title }}</td>
                                    <td>{{ $product->price }}</td>
                                    <td class="text-center">{{ $product->quantity }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('product', $product->slug) }}" target="_blank" class="btn btn-info btn-circle">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="5" class="text-right font-weight-bold">
                                    Total: ${{ $order->total }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>