<?php

namespace App\Livewire\Admin\Order;

use App\Models\Order;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\WithPagination;

#[Title('Orders')]
#[Layout('components.layouts.admin')]
class OrderIndexComponent extends Component
{
    use WithPagination;
    public array $statuses = [];

    #[On('status-changed')]
    public function mount()
    {
        $this->statuses = Order::query()
            ->where('status', '=', 1)
            ->pluck('id')
            ->toArray();
    }


    #[Computed]
    public function orders()
    {
        $this->statuses = Order::query()
            ->where('status', '=', 1)
            ->pluck('id')
            ->toArray();
        $orders_edit = [];
        $orders_edit = Order::query()
            ->select('id', 'status', 'email', 'created_at', 'updated_at', 'total')
            ->paginate(30);


        return $orders_edit;
    }

    public function changeStatus($orderId)
    {
        $orders_all = Order::all('status', 'id')->toArray();

        $searchValueFalse = 0;
        $searchValueTrue = 1;
        $searchKey = 'status';

        $filteredArray = array_filter($orders_all, function ($item) use ($searchKey, $searchValueFalse) {
            return isset($item[$searchKey]) && $item[$searchKey] == $searchValueFalse;
        });
        
        $filteredArray2 = array_filter($orders_all, function ($item) use ($searchKey, $searchValueTrue) {
            return isset($item[$searchKey]) && $item[$searchKey] == $searchValueTrue;
        });
        $orders_status_false = array_column($filteredArray, 'id');
        $orders_status_true = array_column($filteredArray2, 'id');

        $ids_true = array_intersect($orders_status_false, $this->statuses);
        $ids_false = array_diff($orders_status_true, $this->statuses);

        if (!empty($this->statuses)) {
            Order::query()
                ->whereIn('id', $ids_true)
                ->update(['status' => 1]);

            Order::query()
                ->whereIn('id', $ids_false)
                ->update(['status' => 0]);
        }
    }
    public function deleteOrder(Order $order)
    {
        try {
            DB::beginTransaction();

            $order->orderProducts()->delete();
            $order->delete();

            DB::commit();
            $this->js("toastr.error('Order has removed!')");
            return;
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            $this->js("toastr.error('Error deliting order!')");
        }
    }

    public function render()
    {
        return view('livewire.admin.order.order-index-component');
    }
}
