<div class="row">
    <div class="col-xl-8 col-lg-12 offset-xl-2 offset-lg-0 mb-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    <a wire:navigate href="{{ route('admin.products.create') }}" class="btn btn-primary">Add Product</a>
                </h6>
            </div>
            <div class="card-body p-relative">
                <div wire:loading class="loader">
                    <div class="rotate"></div>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered" id="products">
                        <thead>
                            <tr>
                                <th style="width: 5%" class="text-center">ID</th>
                                <th>Image</th>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr wire:key="{{ $product->id }}">
                                    <td>{{ $product->id }}</td>
                                    <td style="width: 50px;"><a href="{{ route('product', $product->slug) }}" target="_blank">
                                        <img width="50" src="{{ asset($product->getImage()) }}">
                                    </a></td>
                                    <td><a href="{{ route('product', $product->slug) }}" target="_blank">
                                        {{ $product->title }}
                                    </a></td>
                                    <td>{{ $product->category->title }}</td>
                                    <td>
                                        <a href="{{ route('product', $product->slug) }}" target="_blank"
                                            class="btn btn-info btn-circle">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        <a wire:navigate href="{{ route('admin.products.edit', $product->id) }}"
                                            class="btn btn-warning btn-circle">
                                            <i class="fa fa-pen"></i>
                                        </a>
                                        <button wire:click="deleteProduct({{ $product->id }})" wire:confirm="Are you sure?"
                                            wire:loading.atrr="disabled" class="btn btn-danger btn-circle">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table> {{ $products->links(data: ['scrollTo' => '#products']) }}
                </div>

            </div>
        </div>
    </div>
</div>