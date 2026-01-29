<?php

namespace App\Livewire\Review;

use App\Helpers\Category\Category;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class ReviewEditComponent extends Component
{
    public Review $review;
    public $evaluation;

    public string $name = '';

    public ?string $pros;

    public ?string $cons;

    public string $content;
    public function mount(Review $review)
    {
        $this->review = $review;
        $this->name = $review->name;
        $this->pros = $review->pros;
        $this->cons = $review->cons;
        $this->content = $review->content;
        $this->evaluation = $review->evaluation;
    }

    public function save()
    {
        $validated = $this->validate([
            'name' => 'required|max:255',
            'pros' => 'nullable|max:255',
            'cons' => 'nullable|max:255',
            'content' => 'required',
            'evaluation' => 'nullable|integer',
        ]);

        $evaluation = intval($validated['evaluation']);
        if ($evaluation < 1 || $evaluation > 5) {
            $validated['evaluation'] = null;
        } else {
            $validated['evaluation'] = round($evaluation);
        }

        try {
            DB::beginTransaction();

            $product = Product::query()
                ->where('id', '=', $this->review->product_id)
                ->firstOrFail();

            $this->review->update($validated);
            $evals = Review::query()
                ->where('product_id', '=', $product->id)
                ->average('evaluation');
            $evals = round($evals, 1);
            Product::query()
                ->where('id', '=', $product->id)
                ->update(['evaluation' => $evals]);
            
            DB::commit();
            session()->flash('success', 'Thanks for your opinion!');
            $this->redirectRoute('product', [$product->slug, 'review_js' => 'true', '#descriptions']);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            $this->js("toastr.error('Error editing review!')");
        }
    }

    public function render()
    {
        $user = $this->review->user_id;
        $product = Product::query()
            ->where('id', '=', $this->review->product_id)
            ->firstOrFail();

        $breadcrumbs = Category::getBreadCrumbs($product->category_id);

        return view('livewire.review.review-edit-component', [
            'title' => 'Review edit',
            'breadcrumbs' => $breadcrumbs,
            'product' => $product,
            'user' => $user,
        ]);
    }
}
