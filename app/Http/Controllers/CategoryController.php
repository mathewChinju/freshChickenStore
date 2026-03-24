<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function __construct()
    {
        // Remove auth middleware for frontend methods
        $this->middleware('auth')->except(['frontendIndex', 'frontendShow']);
    }

    public function frontendIndex(Request $request)
    {
        $categories = Category::where('is_active', true)
            ->with('parent')
            ->withCount('products')
            ->orderBy('name')
            ->get();
            
        $products = Product::where('is_active', true)
            ->with('category.parent', 'images')
            ->latest()
            ->get();
            
        $productsData = $products->map(function ($product) {
            return [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'weight' => $product->weight,
                'description' => $product->description,
                'sku' => $product->sku,
                'stock_quantity' => $product->stock_quantity,
                'primary_image_url' => $product->primary_image_url,
                'category' => $product->category ? $product->category->name : 'General',
                'category_slug' => $product->category ? $product->category->slug : 'general',
                'category_parent' => $product->category && $product->category->parent ? $product->category->parent->name : null,
                'rating' => $product->rating,
                'is_out_of_stock' => $product->is_out_of_stock,
                'stock_status' => $product->stock_status,
                'whatsapp_url' => route('products.whatsapp', $product)
            ];
        });
            
        return view('categories_fresh', compact('categories', 'products', 'productsData'));
    }

    public function index(Request $request)
    {
        $query = Category::withCount('products')
            ->with('parent');
        
        // Search filter
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('name', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('description', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('slug', 'LIKE', "%{$searchTerm}%");
            });
        }
        
        // Parent filter
        if ($request->filled('parent_id')) {
            if ($request->parent_id === 'root') {
                $query->whereNull('parent_id');
            } else {
                $query->where('parent_id', $request->parent_id);
            }
        }
        
        // Status filter
        if ($request->filled('status')) {
            $query->where('is_active', $request->status === 'active');
        }
        
        // Sort filter
        $sortField = $request->get('sort', 'sort_order');
        $sortDirection = 'asc';
        
        switch ($sortField) {
            case 'name':
                $query->orderBy('name', 'asc');
                break;
            case 'created_at':
                $query->orderBy('created_at', 'desc');
                break;
            case 'products_count':
                $query->orderBy('products_count', 'desc');
                break;
            case 'sort_order':
            default:
                $query->orderBy('sort_order', 'asc')
                      ->orderBy('name', 'asc');
                break;
        }
        
        $categories = $query->paginate(10);
        
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
            'description' => 'nullable|string|max:1000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_active' => 'boolean',
            'sort_order' => 'integer|min:0',
            'parent_id' => 'nullable|exists:categories,id'
        ]);

        $data = $request->except('image');
        $data['slug'] = Str::slug($request->name);
        
        // Handle checkbox properly
        $data['is_active'] = $request->has('is_active');

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/categories'), $imageName);
            $data['image'] = $imageName;
        }

        Category::create($data);

        return redirect()->route('admin.categories.index')
            ->with('success', 'Category created successfully!');
    }

    public function show(Category $category)
    {
        $category->load('products');
        return view('admin.categories.show', compact('category'));
    }

    public function details(Category $category)
    {
        $category->load(['parent', 'children']);
        
        return response()->json([
            'id' => $category->id,
            'name' => $category->name,
            'slug' => $category->slug,
            'description' => $category->description,
            'image' => $category->image,
            'parent_name' => $category->parent?->name,
            'sort_order' => $category->sort_order,
            'is_active' => $category->is_active,
            'created_at' => $category->created_at->format('M j, Y g:i A'),
            'updated_at' => $category->updated_at->format('M j, Y g:i A'),
            'products_count' => $category->products_count ?? $category->products()->count(),
            'subcategories_count' => $category->children()->count(),
            'total_products' => $category->products()->count(),
        ]);
    }

    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
            'description' => 'nullable|string|max:1000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_active' => 'boolean',
            'sort_order' => 'integer|min:0',
            'parent_id' => 'nullable|exists:categories,id'
        ]);

        $data = $request->except('image');
        $data['slug'] = Str::slug($request->name);

        // Handle checkbox properly
        $data['is_active'] = $request->has('is_active');

        if ($request->hasFile('image')) {
            // Delete old image
            if ($category->image && file_exists(public_path('images/categories/' . $category->image))) {
                unlink(public_path('images/categories/' . $category->image));
            }

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/categories'), $imageName);
            $data['image'] = $imageName;
        }

        $category->update($data);

        return redirect()->route('admin.categories.index')
            ->with('success', 'Category updated successfully!');
    }

    public function destroy(Category $category)
    {
        // Check if category has products
        if ($category->products()->count() > 0) {
            return redirect()->route('admin.categories.index')
                ->with('error', 'Cannot delete category. It has associated products.');
        }

        // Delete image
        if ($category->image && file_exists(public_path('images/categories/' . $category->image))) {
            unlink(public_path('images/categories/' . $category->image));
        }

        $category->delete();

        return redirect()->route('admin.categories.index')
            ->with('success', 'Category deleted successfully!');
    }

    public function toggleStatus(Category $category)
    {
        $category->is_active = !$category->is_active;
        $category->save();

        $status = $category->is_active ? 'activated' : 'deactivated';
        
        return redirect()->route('admin.categories.index')
            ->with('success', "Category {$status} successfully!");
    }
}
