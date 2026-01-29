<?php

namespace App\Livewire\Cart;

use App\Helpers\Cart\Cart;
use App\Mail\OrderClient;
use App\Mail\OrderManager;
use App\Models\Order;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class CheckoutComponent extends Component
{
    public string $name;
    public string $email;
    public string $number;
    public string $note;

    public function mount()
    {
        $this->name = auth()->user()->name ?? '';
        $this->email = auth()->user()->email ?? '';
        $this->number = auth()->user()->number ?? '';
    }

    public function saveOrder()
    {
        $validated = $this->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'number' => 'required|max:255',
            'note' => 'string|nullable',
        ]);
        $validated = array_merge($validated, [
            'user_id' => auth()->id(),
            'total' => Cart::getCartTotalSum()
        ]);

        try {
            DB::beginTransaction();
            $order = Order::create($validated);
            $order_products = [];
            $cart = Cart::getCart();

            foreach ($cart as $product_id => $product) {
                $order_products[] = [
                    'product_id' => $product_id,
                    'title' => $product['title'],
                    'price' => $product['price'],
                    'slug' => $product['slug'],
                    'quantity' => $product['quantity'],
                    'image' => $product['image'],
                ];
            }

            $order->orderProducts()->createMany($order_products);
            DB::commit();

            try {
                Mail::to($validated['email'])->send(new OrderClient(
                    $order_products,
                    Cart::getCartTotalSum(),
                    $order->id,
                    $validated['note']
                ));
                Mail::to('minet.tester671@gmail.com')->send(new OrderManager($order->id));
            } catch (\Exception $e) {
                Log::error($e->getMessage());
            }
            
            Cart::clearCart();
            $this->dispatch('cart-updated');
            session()->flash('success', 'Thanks for chusing us! We\'ll call your back later!');
            $this->redirectRoute('home', navigate: true);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            $this->js("toastr.error('Error ordering!')");
        }
    }
    public function render()
    {
        return view('livewire.cart.checkout-component', [
            'title' => 'Checkout',
        ]);
    }
}
