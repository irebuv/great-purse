<?php

namespace App\Livewire\Admin\Product;

use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Validate;
use Livewire\Component;
use App\Helpers\Category\Category as CategoryHelpers;
use App\Helpers\Traits\Admin\ProductTrait;
use App\Models\Filter;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\WithFileUploads;

#[Title('Products edit')]
#[Layout('components.layouts.admin')]
class ProductEditComponent extends Component
{
    use WithFileUploads, ProductTrait;
    public Product $product;
    public string $title;
    public $category_id;
    public array $selectedFilters = [];
    public ?string $excerpt;
    public string $content = '';
    public $photo;
    public $photos;
    public int $price;
    public ?int $old_price;
    public bool $is_hit = false;
    public bool $is_new = false;
    #[Validate]
    public $image;
    #[Validate]
    public $gallery;

    public function mount(Product $product)
    {
        $this->product = $product;
        $this->title = $product->title;
        $this->category_id = $product->category_id;
        $this->price = $product->price;
        $this->old_price = $product->old_price;
        $this->is_hit = $product->is_hit;
        $this->is_new = $product->is_new;
        $this->excerpt = $product->excerpt;
        $this->content = $product->content;
        $this->photo = $product->image;
        $this->photos = $product->gallery;
        $this->selectedFilters = DB::table('filter_products')
            ->where('product_id', '=', $this->product->id)
            ->pluck('filter_id')
            ->toArray();
    }

    public function render()
    {
        return view('livewire.admin.product.product-edit-component');
    }

    public function save()
    {
        $validated = $this->validate();
        $folders = date('Y') . '/' . date('m') . '/' . date('d');

        if (!empty($validated['image'])) {
            if($this->product->image){
                Storage::disk('public_uploads_delete')->delete($this->product->image);
            }
            $validated['image'] = "uploads/" . $validated['image']->store($folders);
        } else {
            $validated['image'] = $this->photo;
        }
        
        $galleryKey = array_values($this->photos);
        $photosKey = array_values($this->product->gallery);
        $galleryDifferent = array_diff($photosKey, $galleryKey);

        if (!empty($validated['gallery'])) {
            Storage::disk('public_uploads_delete')->delete($galleryDifferent);
            foreach ($validated['gallery'] as $k => $photo) {
                $validated['gallery'][$k] = "uploads/" . $photo->store($folders);
            }
            $validated['gallery'] = array_merge($validated['gallery'], $this->photos);
        } else {
            Storage::disk('public_uploads_delete')->delete($galleryDifferent);
            $validated['gallery'] = $this->photos;
        }

        try {
            DB::beginTransaction();

            $this->product->update($validated);
            DB::table('filter_products')
                ->where('product_id', '=', $this->product->id)
                ->delete();

            if (!empty($validated['selectedFilters'])) {
                $filter_groups = Filter::query()
                    ->whereIn('id', $validated['selectedFilters'])
                    ->get();
                $data = [];
                foreach ($filter_groups as $filter_group) {
                    $data[] = [
                        'filter_id' => $filter_group->id,
                        'product_id' => $this->product->id,
                        'filter_group_id' => $filter_group->filter_group_id,
                    ];
                }
                DB::table('filter_products')->insert($data);
            }

            DB::commit();
            session()->flash('success', 'Product updated successfully');
            $this->redirectRoute('admin.products.index', navigate: true);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            $this->js("toastr.error('Error updating product!')");
        }
    }
    public function deleteGalleryItem($id)
    {
        if (isset($this->photos[$id])) {
            unset($this->photos[$id]);
        }
    }
}
