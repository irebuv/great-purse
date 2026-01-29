<?php

namespace App\Livewire\Admin\Filter;

use App\Models\Filter;
use App\Models\FilterGroup;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Title('Edit Filter')]
#[Layout('components.layouts.admin')]
class FilterEditComponent extends Component
{
    public FilterGroup $filter_groups;
    public string $title;
    public array $filters = [];
    public array $filters_title = [];
    public string $add_filter;

    public function mount(FilterGroup $filter_groups)
    {
        $this->filter_groups = $filter_groups;
        $this->title = $filter_groups->title;
        $this->filters = Filter::query()
            ->where('filter_group_id', '=', $this->filter_groups->id)
            ->where('visible', '=', 1)
            ->pluck('id')
            ->toArray();
        $filteredArray = Filter::all('id', 'title', 'filter_group_id')
            ->where('filter_group_id', '=', $this->filter_groups->id)
            ->toArray();

        $this->filters_title = array_column($filteredArray, 'title', 'id');
    }

    #[Computed]
    public function filtersEdit()
    {
        $this->filters = Filter::query()
            ->where('filter_group_id', '=', $this->filter_groups->id)
            ->where('visible', '=', 1)
            ->pluck('id')
            ->toArray();
        $filteredArray = Filter::all('id', 'title', 'filter_group_id')
            ->where('filter_group_id', '=', $this->filter_groups->id)
            ->toArray();

        $this->filters_title = array_column($filteredArray, 'title', 'id');
        $filter_edit = [];
        $ids = $this->filter_groups->id;
        $filter_edit = DB::table('filters')
            ->select('id', 'title')
            ->whereIn('filter_group_id', explode(',', $ids))
            ->get();

        return $filter_edit;
    }

    public function addFilter()
    {
        $validate = $this->validate([
            'add_filter' => 'required|max:255',
        ]);

        $validate['filter_group_id'] = $this->filter_groups->id;
        $validate['title'] = $this->add_filter;

        Filter::create($validate);

        $this->reset('add_filter');
    }

    public function save()
    {
        $validated = $this->validate([
            'title' => 'required|max:255',
            'filters.*' => 'numeric',
            'filters_title.*' => 'required',
        ]);

        if (empty($validated['filters'])) {
            $this->js("toastr.error('At least one filter must be visible!')");
            return;
        }

        try {
            DB::beginTransaction();
            Filter::query()
                ->where('filter_group_id', '=', $this->filter_groups->id)
                ->update(['visible' => 0]);

            if (!empty($validated['filters'])) {
                Filter::query()
                    ->whereIn('id', $validated['filters'])
                    ->update(['visible' => 1]);
            }
            if (!empty($validated['filters_title'])) {
                foreach ($validated['filters_title'] as $k => $filter) {
                    Filter::query()
                        ->where('id', '=', $k)
                        ->update(['title' => $filter]);
                }
            }

            $this->filter_groups->update(['title' => $this->title]);

            DB::commit();
            session()->flash('success', 'Filter group updated successfully');
            $this->redirectRoute('admin.filters.index', navigate: true);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            $this->js("toastr.error('Error updating filter or group of filters!')");
        }
    }
    public function render()
    {
        return view('livewire.admin.filter.filter-edit-component');
    }
}
