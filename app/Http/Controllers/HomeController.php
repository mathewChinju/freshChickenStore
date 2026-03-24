<?php

namespace App\Http\Controllers;

use App\Models\Product;

class HomeController extends Controller
{
    /**
     * Show the application home page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $categories = \App\Models\Category::where('is_active', true)
            ->whereNull('parent_id') // Only get top-level categories, no subcategories
            ->withCount('products')
            ->latest() // Order by latest created
            ->take(5) // Limit to 5 categories for home page
            ->get();
            
        // Get latest product from each of the top 4 categories for variety
        $featuredCategories = \App\Models\Category::where('is_active', true)
            ->has('products')
            ->take(4)
            ->get();

        $products = collect();
        foreach ($featuredCategories as $category) {
            $latestProduct = $category->products()
                ->where('is_active', true)
                ->with('category', 'images')
                ->latest()
                ->first();
            if ($latestProduct) {
                $products->push($latestProduct);
            }
        }

        // If less than 4 products from categories, fill with latest general products
        if ($products->count() < 4) {
            $extraProducts = Product::where('is_active', true)
                ->whereNotIn('id', $products->pluck('id'))
                ->with('category', 'images')
                ->latest()
                ->take(4 - $products->count())
                ->get();
            $products = $products->concat($extraProducts);
        }

        // Ensure we only have 4 (or whatever limit)
        $products = $products->take(4);

        $productsData = $products->map(function ($product) {
            return [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'weight' => $product->weight,
                'description' => $product->description,
                'sku' => $product->sku,
                'stock_quantity' => $product->stock_quantity,
                'image' => $product->image,
                'category' => $product->category ? $product->category->name : 'General',
                'rating' => $product->rating,
                'is_out_of_stock' => $product->is_out_of_stock,
                'stock_status' => $product->stock_status,
                'whatsapp_url' => route('products.whatsapp', $product)
            ];
        });

        return view('home', compact('products', 'productsData', 'categories'));
    }
}
