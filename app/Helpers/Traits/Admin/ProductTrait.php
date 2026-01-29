<?php

namespace App\Helpers\Traits\Admin;

use App\Helpers\Category\Category;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Computed;

trait ProductTrait
{

    #[Computed]
    public function filters()
    {
        $filter_groups = [];
        if ($this->category_id) {
            //$ids = Category::getIds($this->category_id) . $this->category_id;
            $ids = $this->category_id;
            $category_filters = DB::table('category_filters')
                ->select('category_filters.filter_group_id', 'filter_groups.title',
                 'filters.id as filter_id', 'filters.title as filter_title', 'filters.visible as filter_visible')
                ->join('filter_groups', 'category_filters.filter_group_id', '=', 'filter_groups.id')
                ->join('filters', 'filters.filter_group_id', '=', 'filter_groups.id')
                ->whereIn('category_filters.category_id', explode(',', $ids))
                ->get();

            foreach ($category_filters as $filter) {
                $filter_groups[$filter->filter_group_id][] = $filter;
            }
        }
        return $filter_groups;
    }
    protected function rules()
    {
        return [
            'title' => 'required|max:255',
            'category_id' => 'required|exists:categories,id',
            'selectedFilters.*' => 'numeric',
            'price' => 'required|integer',
            'old_price' => 'nullable|integer',
            'is_hit' => 'boolean',
            'is_new' => 'boolean',
            'excerpt' => 'nullable|max:255',
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,ico|max:6096',
            'gallery.*' => 'nullable|image|mimes:jpg,jpeg,png,ico|max:6096',
        ];
    }

    public function updatedCategoryId()
    {
        $this->selectedFilters = [];
    }
}
