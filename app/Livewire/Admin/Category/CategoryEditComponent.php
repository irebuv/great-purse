<?php

namespace App\Livewire\Admin\Category;

use App\Models\Category;
use App\Models\FilterGroup;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;


#[Title('Edit Category')]
#[Layout('components.layouts.admin')]
class CategoryEditComponent extends Component
{
    public Category $category;
    public string $title;
    public $parent_id = 0;
    public $id;
    public array $selected_categories_filters = [];

    public function mount(Category $category)
    {
        $this->category = $category;
        $this->title = $category->title;
        $this->parent_id = $category->parent_id;
        $this->id = $category->id;
        $this->selected_categories_filters = DB::table('category_filters')
            ->where('category_id', '=', $this->category->id)
            ->pluck('filter_group_id')
            ->toArray();
    }

    public function save()
    {
        $validated = $this->validate([
            'title' => 'required|max:255',
            'parent_id' => 'required|integer',
            'selected_categories_filters.*' => 'numeric',
        ]);

        try {
            DB::beginTransaction();
            $this->category->update($validated);
            DB::table('category_filters')
                ->where('category_id', '=', $this->category->id)
                ->delete();

            if (!empty($validated['selected_categories_filters'])) {
                $data = [];
                foreach ($validated['selected_categories_filters'] as $category_filter) {
                    $data[] = [
                        'category_id' => $this->category->id,
                        'filter_group_id' => $category_filter,
                    ];
                }
                DB::table('category_filters')->insert($data);
            }
            DB::commit();

            cache()->forget('categories_html');
            session()->flash('success', 'Category updated successfully');
            $this->redirectRoute('admin.categories.index', navigate: true);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            $this->js("toastr.error('Error updating category!')");
        }
    }
    public function render()
    {
        $filter_groups = FilterGroup::all();
        return view('livewire.admin.category.category-edit-component', [
            'filter_groups' => $filter_groups,
        ]);
    }
}
