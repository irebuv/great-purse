<?php

namespace App\Livewire\Admin\Filter;

use App\Models\Filter;
use App\Models\FilterGroup;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Title('Create Filter')]
#[Layout('components.layouts.admin')]
class FilterCreateComponent extends Component
{
    public string $title;
    public array $add_filters = [];

    public function mount()
    {
        $this->add_filters = [];
    }

    #[Computed]
    public function filtersAdd()
    {
        $empty_filter = [];
        foreach ($this->add_filters as $k => $v) {
            if (empty($v)) {
                $empty_filter[] = $k;
            }
        }

        if (empty($empty_filter)) {
            array_push($this->add_filters, null);
        }


        $filters_add = $this->add_filters;
        return $filters_add;
    }

    public function removeFilter($filterId)
    {
        unset($this->add_filters[$filterId]);
        $new_array = $this->add_filters;
        $this->add_filters = [];
        foreach ($new_array as $value) {
            $this->add_filters[] = $value;
        }

        if (count($this->add_filters) == 1) {
            $this->add_filters = [];
        }
    }

    public function save()
    {
        $this->add_filters = array_filter($this->add_filters);
        $validated = $this->validate([
            'title' => 'required|max:255',
            'add_filters.*' => 'required',
        ]);
        if (empty($validated['add_filters'])) {
            $this->js("toastr.error('At least one filter must be!')");
            return;
        }
        try {
            DB::beginTransaction();
            $filter_group = FilterGroup::create(['title' => $this->title]);

            foreach ($validated['add_filters'] as $k => $filter) {
                Filter::create([
                    'title' => $filter,
                    'filter_group_id' => $filter_group->id,
                ]);
            }

            DB::commit();
            session()->flash('success', 'Filter group created successfully');
            $this->redirectRoute('admin.filters.index', navigate: true);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            $this->js("toastr.error('Error saving filter or group of filters!')");
        }
    }
    public function render()
    {
        return view('livewire.admin.filter.filter-create-component');
    }
}
