<?php

namespace App\Helpers\Wish;

use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Wish
{

    public static function add2Wish(int $productId): bool
    {
        $added = false;
        if (Auth::user()) {
            $user = auth()->user()->id;
            if (self::hasProductInWish($productId)) {
                DB::table('wish_products')
                    ->where('user_id', '=', $user)
                    ->where('product_id', '=', $productId)
                    ->delete();
                $added = true;
            } else {
                $product = Product::query()->find($productId);
                if ($product) {
                    DB::table('wish_products')
                        ->insert(['user_id' => $user, 'product_id' => $productId, 'updated_at' => date("Y-m-d H:i:s")]);
                }
                $added = true;
            }
        } else {
            if (self::hasProductInWish($productId)) {
                session()->forget("wish.{$productId}");
                $added = true;
            } else {
                $product = Product::query()->find($productId);
                if ($product) {
                    $new_product = [
                        'product_id' => $productId,
                        'title' => $product->title,
                        'slug' => $product->slug,
                        'image' => $product->getImage(),
                        'price' => $product->price,
                    ];
                    $new_product = (object)$new_product;
                    session(["wish.{$productId}" => $new_product]);
                    $added = true;
                }
            }
        }
        return $added;
    }

    public static function getWish(): array
    {
        if (Auth::user()) {
            $user = auth()->user()->id;
            $actives_wish = self::activeWishProduct();
            $wishList = DB::table('wish_products')
                ->whereIn('wish_products.product_id', $actives_wish)
                ->where('user_id', '=', $user)
                ->select('wish_products.product_id', 'products.title', 'products.image',
                 'products.slug', 'wish_products.updated_at as updated_time')
                ->join('products', 'products.id', '=', 'wish_products.product_id')
                ->orderBy('wish_products.updated_at', 'desc')
                ->get()
                ->toArray();
        } else {
            $wishList = session('wish') ?: [];
        }
        return $wishList;
    }

    public static function activeWishProduct()
    {
        if (Auth::user()) {
            $user = auth()->user()->id;
            $wishList = DB::table('wish_products')
                ->where('user_id', '=', $user)
                ->get('product_id')->toArray();
            $actives_wish = array_column($wishList, 'product_id');
        } else {
            $array = session('wish') ?: [];
            $actives_wish = array_keys($array);
        }
           $actives_wish = array_values($actives_wish);
        return $actives_wish;
    }

    public static function hasProductInWish(int $productId): bool
    {

        if (Auth::user()) {
            $user = auth()->user()->id;

            $count = DB::table('wish_products')
                ->where('user_id', '=', $user)
                ->where('product_id', '=', $productId)
                ->count();

            if ($count > 0) {
                $has_wish = true;
            } else {
                $has_wish = false;
            }
        } else {
            $has_wish = session()->has("wish.$productId");
        }

        return $has_wish;
    }
    public static function removeFromWish($productId): bool
    {
        $deleted = false;
        if (Auth::user()) {
            $user = auth()->user()->id;
            DB::table('wish_products')
                ->where('user_id', '=', $user)
                ->where('product_id', '=', $productId)
                ->delete();
            $deleted = true;
        } else {
            if (self::hasProductInWish($productId)) {
                session()->forget("wish.{$productId}");
                $deleted = true;
            }
        }
        return $deleted;
    }

    public static function clearWish(): bool
    {
        $deleted = false;
        if (Auth::user()) {
            $user = auth()->user()->id;
            DB::table('wish_products')
                ->where('user_id', '=', $user)
                ->delete();
            $deleted = true;
        } else {
            session()->forget('wish');
            $deleted = true;
        }
        return $deleted;
    }
}
