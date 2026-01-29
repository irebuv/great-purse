<?php

use App\Livewire\Admin\Category\CategoryCreateComponent;
use App\Livewire\Admin\Category\CategoryEditComponent;
use App\Livewire\Admin\Category\CategoryIndexComponent;
use App\Livewire\Admin\Filter\FilterCreateComponent;
use App\Livewire\Admin\Filter\FilterEditComponent;
use App\Livewire\Admin\Filter\FilterIndexComponent;
use App\Livewire\Admin\HomeComponent as AdminHomeComponent;
use App\Livewire\Admin\Order\OrderEditComponent;
use App\Livewire\Admin\Order\OrderIndexComponent;
use App\Livewire\Admin\Product\ProductCreateComponent;
use App\Livewire\Admin\Product\ProductEditComponent;
use App\Livewire\Admin\Product\ProductIndexComponent;
use App\Livewire\Admin\User\UserCreateComponent;
use App\Livewire\Admin\User\UserEditComponent;
use App\Livewire\Admin\User\UserIndexComponent;
use App\Livewire\Cart\Cart;
use App\Livewire\Cart\CheckoutComponent;
use App\Livewire\HomeComponent;
use App\Livewire\Product\CategoryComponent;
use App\Livewire\Product\ProductComponent;
use App\Livewire\Review\ReviewEditComponent;
use App\Livewire\Search\SearchComponent;
use App\Livewire\User\AccountComponent;
use App\Livewire\User\LoginComponent;
use App\Livewire\User\OrderShowComponent;
use App\Livewire\User\RegisterComponent;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeComponent::class)->name('home');
Route::get('/category/{slug}', CategoryComponent::class)->name('category');
Route::get('/product/{slug}', ProductComponent::class)->name('product');
Route::get('/cart', Cart::class)->name('cart');
Route::get('/checkout', CheckoutComponent::class)->name('checkout');
Route::get('/search', SearchComponent::class)->name('search');

Route::middleware('guest')->group(function () {
    Route::get('/register', RegisterComponent::class)->name('register');
    Route::get('/login', LoginComponent::class)->name('login');
});
Route::middleware('auth')->group(function () {
    Route::get('/logout', function () {
        auth()->logout();
        return redirect()->route('login');
    })->name('logout');

    Route::get('/account', AccountComponent::class)->name('account');
    Route::get('/order-show/{id}', OrderShowComponent::class)->name('order-show');

    Route::get('/review/{review}/edit', ReviewEditComponent::class)->name('review.edit');
});




Route::prefix('admin-page')->middleware('admin')->group(function () {
    Route::get('/', AdminHomeComponent::class)->name('admin');

    Route::get('/categories', CategoryIndexComponent::class)->name('admin.categories.index');
    Route::get('/categories/create', CategoryCreateComponent::class)->name('admin.categories.create');
    Route::get('/categories/{category}/edit', CategoryEditComponent::class)->name('admin.categories.edit');

    Route::get('/products', ProductIndexComponent::class)->name('admin.products.index');
    Route::get('/products/create', ProductCreateComponent::class)->name('admin.products.create');
    Route::get('/products/{product}/edit', ProductEditComponent::class)->name('admin.products.edit');

    Route::get('/filters', FilterIndexComponent::class)->name('admin.filters.index');
    Route::get('/filters/create', FilterCreateComponent::class)->name('admin.filters.create');
    Route::get('/filters/{filter_groups}/edit', FilterEditComponent::class)->name('admin.filters.edit');

    Route::get('/orders', OrderIndexComponent::class)->name('admin.orders.index');
    Route::get('/orders/{order}/edit', OrderEditComponent::class)->name('admin.orders.edit');

    Route::get('/users', UserIndexComponent::class)->name('admin.users.index');
    Route::get('/users/create', UserCreateComponent::class)->name('admin.users.create');
    Route::get('/users/{user}/edit', UserEditComponent::class)->name('admin.users.edit');
});
