<?php

namespace App\Livewire\Product;

use App\Helpers\Category\Category;
use App\Helpers\Traits\CartTrait;
use App\Helpers\Traits\WishTrait;
use App\Models\FilterGroup;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

use function PHPUnit\Framework\isNumeric;

class ProductComponent extends Component
{
    use CartTrait, WishTrait, WithPagination;
    public string $slug = '';

    public $evaluation;

    public string $name = '';

    public string $pros;

    public string $cons;

    public string $content;


    public function mount($slug)
    {
        $this->slug = $slug;
        if (Auth::user()) {
            $this->name = auth()->user()->name;
        }
        $product = Product::query()
            ->where('slug', '=', $this->slug)
            ->firstOrFail();
    }

    public function saveReview()
    {
        $validated = $this->validate([
            'name' => 'required|max:255',
            'pros' => 'nullable|max:255',
            'cons' => 'nullable|max:255',
            'content' => 'required',
            'evaluation' => 'nullable|integer',
        ]);

        $product = Product::query()
            ->where('slug', '=', $this->slug)
            ->firstOrFail();

        $evaluation = intval($validated['evaluation']);
        if ($evaluation < 1 || $evaluation > 5) {
            $validated['evaluation'] = null;
        } else {
            $validated['evaluation'] = round($evaluation);
        }

        if (Auth::user()) {
            $validated['user_id'] = auth()->user()->id;
        }
        $validated['product_id'] = $product->id;

        try {
            DB::beginTransaction();

            Review::create($validated);
            $count_reviews = Review::query()
                ->where('product_id', '=', $product->id)
                ->count();
            if (!isNumeric($count_reviews)) {
                $count_reviews = 0;
            }
            $evals = Review::query()
                ->where('product_id', '=', $product->id)
                ->average('evaluation');
            $evals = round($evals, 1);
            Product::query()
                ->where('id', '=', $product->id)
                ->update(['evaluation' => $evals, 'reviews' => $count_reviews]);

            DB::commit();
            session()->flash('success', 'Thanks for your opinion!');
            $this->redirectRoute('product', [$product->slug, 'review_js' => 'true', '#descriptions']);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            $this->js("toastr.error('Error creating review!')");
        }
    }

    public function removeReview($commentId)
    {
        $product = Product::query()
            ->where('slug', '=', $this->slug)
            ->firstOrFail();

        try {
            DB::beginTransaction();

            Review::where('id', '=', $commentId)->delete();
            $count_reviews = Review::query()
                ->where('product_id', '=', $product->id)
                ->count();
            if (!isNumeric($count_reviews)) {
                $count_reviews = 0;
            }
            $evals = Review::query()
                ->where('product_id', '=', $product->id)
                ->average('evaluation');
            $evals = round($evals, 1);
            Product::query()
                ->where('id', '=', $product->id)
                ->update(['evaluation' => $evals, 'reviews' => $count_reviews]);

            DB::commit();
            $this->js("toastr.success('You deleted the review!')");
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            $this->js("toastr.error('Error deleting review!')");
        }
    }

    #[On('wish-updated')]
    public function render()
    {

        $product = Product::query()
            ->where('slug', '=', $this->slug)
            ->firstOrFail();

        $related_products = Product::query()
            ->where('category_id', '=', $product->category_id)
            ->where('id', '!=', $product->category_id)
            ->limit(6)
            ->get();

        $breadcrumbs = Category::getBreadCrumbs($product->category_id);

        $attributes = FilterGroup::query()
            ->selectRaw('filter_groups.title as filter_groups_title, GROUP_CONCAT(filters.title SEPARATOR ", ") as filters_title')
            ->join('filters', 'filters.filter_group_id', '=', 'filter_groups.id')
            ->join('filter_products', 'filter_products.filter_id', '=', 'filters.id')
            ->where('filter_products.product_id', '=', $product->id)
            ->groupBy('filter_groups.title')
            ->get();

        $comments = Review::query()
            ->where('product_id', '=', $product->id)
            ->orderBy('id', 'desc')
            ->paginate(10);

        $counter_commetns = Review::query()
            ->where('product_id', '=', $product->id)
            ->count();

        $title =  $product->title;

        return view('livewire.product.product-component', [
            'title' => $title,
            'product' => $product,
            'related_products' => $related_products,
            'breadcrumbs' => $breadcrumbs,
            'attributes' => $attributes,
            'comments' => $comments,
            'counter_commetns' => $counter_commetns,
        ]);
    }
}
