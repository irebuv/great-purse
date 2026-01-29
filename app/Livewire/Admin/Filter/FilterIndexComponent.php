<?php

namespace App\Livewire\Admin\Filter;

use App\Models\Filter;
use App\Models\FilterGroup;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Title('Filters')]
#[Layout('components.layouts.admin')]
class FilterIndexComponent extends Component
{
    use WithPagination;

    public function deleteFilterGroup(FilterGroup $filterGroup)
    {
        try {
            DB::beginTransaction();

            DB::table('filter_products')
                ->where('filter_group_id', '=', $filterGroup->id)
                ->delete();

            Filter::query()
                ->where('filter_group_id', '=', $filterGroup->id)
                ->delete();

            DB::table('category_filters')
                ->where('filter_group_id', '=', $filterGroup->id)
                ->delete();

            $filterGroup->delete();

            DB::commit();
            $this->js("toastr.success('You deleted the filter group!')");
            return;
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            $this->js("toastr.error('Error deleting filter group!')");
        }
    }
    public function removeFilter($filterID)
    {
        try {
            DB::beginTransaction();

            DB::table('filter_products')
                ->where('filter_id', '=', $filterID)
                ->delete();

            Filter::where('id', '=', $filterID)->delete();

            DB::commit();
            $this->js("toastr.success('You deleted the filter!')");
            return;
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            $this->js("toastr.error('Error deleting the filter!')");
        }
    }
    public function render()
    {
        $filter_groups = FilterGroup::orderBy('id', 'desc')->paginate(10);
        return view('livewire.admin.filter.filter-index-component', compact('filter_groups'));
    }
}
