<?php

namespace App\Livewire\Admin\Product;

use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\Attributes\Validate;
use Livewire\WithFileUploads;
use App\Helpers\Category\Category as CategoryHelpers;
use App\Helpers\Traits\Admin\ProductTrait;
use App\Models\Filter;
use App\Models\Product;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Title('Create Product')]
#[Layout('components.layouts.admin')]
class ProductCreateComponent extends Component
{
    use WithFileUploads, ProductTrait;
    public string $title;
    public $category_id;
    public array $selectedFilters = [];
    public string $excerpt;
    public string $content = '';
    public int $price;
    public ?int $old_price;
    public bool $is_hit = false;
    public bool $is_new = false;
    #[Validate]
    public $image;
    #[Validate]
    public $gallery;

    public function save(){
        $validated = $this->validate();
        
        $folders = date('Y') . '/' . date('m') . '/' . date('d');

        if ($validated['image']){
            $validated['image'] = "uploads/" . $validated['image']->store($folders);
        }

        if (!empty($validated['gallery'])) {
            foreach ($validated['gallery'] as $k => $photo){
                $validated['gallery'][$k] = "uploads/" . $photo->store($folders);
            }
        }
        
        try {
            DB::beginTransaction();
            
            $product = Product::create($validated);

            if (!empty($validated['selectedFilters'])){
                $filter_groups = Filter::query()
                    ->whereIn('id', $validated['selectedFilters'])
                    ->get();
                    $data = [];
                    foreach ($filter_groups as $filter_group){
                        $data[] = [
                            'filter_id' => $filter_group->id,
                            'product_id' => $product->id,
                            'filter_group_id' => $filter_group->filter_group_id,
                        ];
                    }
                    DB::table('filter_products')->insert($data);
            }

            DB::commit();
            session()->flash('success', 'Product created successfully');
            $this->redirectRoute('admin.products.index', navigate: true);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            $this->js("toastr.error('Error saving product!')");
        }
    }
    public function render()
    {
        return view('livewire.admin.product.product-create-component');
    }
}
