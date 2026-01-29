<?php

namespace App\Livewire\Admin\Category;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Title('Categories')]
#[Layout('components.layouts.admin')]
class CategoryIndexComponent extends Component
{
    public function deleteCategory(Category $category)
    {
        $categories_cnt = Category::where('parent_id', '=', $category->id)->count();
        if ($categories_cnt) {
            $this->js("toastr.error('Erorr! This category has child!')");
            return;
        }

        $products_cnt = Product::where('category_id', '=', $category->id)->count();
        if ($products_cnt) {
            $this->js("toastr.error('Erorr! This catagory has products!')");
            return;
        }

        try {
            DB::beginTransaction();
            DB::table('category_filters')
                ->where('category_id', '=', $category->id)
                ->delete();
            $category->delete();
            DB::commit();

            cache()->forget('categories_html');
            $this->js("toastr.success('Category removed!')");
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            $this->js("toastr.error('Error deleting category!')");
        }
    }

    public function render()
    {
        return view('livewire.admin.category.category-index-component');
    }
}
