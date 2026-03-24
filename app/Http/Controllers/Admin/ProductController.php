<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function index(Request $request)
    {
        $query = Product::with('category', 'images');

        // Search functionality
        if ($request->filled('search')) {
            $query->search($request->search);
        }

        // Category filter
        if ($request->filled('category_id')) {
            $query->byCategory($request->category_id);
        }

        // Status filter
        if ($request->filled('status')) {
            if ($request->status === 'active') {
                $query->where('is_active', true);
            } elseif ($request->status === 'inactive') {
                $query->where('is_active', false);
            }
        }

        // Stock status filter
        if ($request->filled('stock_status')) {
            $query->byStock($request->stock_status);
        }

        // Price range filter
        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }
        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        // Date range filter
        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        // Sorting
        if ($request->filled('sort')) {
            switch ($request->sort) {
                case 'name':
                    $query->orderBy('name');
                    break;
                case 'price_asc':
                    $query->orderBy('price', 'asc');
                    break;
                case 'price_desc':
                    $query->orderBy('price', 'desc');
                    break;
                case 'stock':
                    $query->orderBy('stock_quantity', 'desc');
                    break;
                case 'created_at':
                    $query->orderBy('created_at', 'desc');
                    break;
                default:
                    $query->latest();
            }
        } else {
            $query->latest();
        }

        $products = $query->with('category.parent')->paginate(10)->withQueryString();
        
        // Load categories for filter dropdown with parent relationship
        $categories = Category::where('is_active', true)
            ->with('parent')
            ->orderBy('name')
            ->get();

        return view('admin.products.index', compact('products', 'categories'));
    }

    public function create()
    {
        $categories = Category::where('is_active', true)
            ->with('parent')
            ->orderBy('name')
            ->get();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock_quantity' => 'nullable|integer|min:0',
            'sku' => 'required|string|unique:products',
            'weight' => 'nullable|string|max:255',
            'category_id' => 'nullable|exists:categories,id',
            'images' => 'nullable|array|max:5',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_active' => 'boolean',
            'rating' => 'nullable|numeric|min:0|max:5',
            'is_out_of_stock' => 'boolean',
            'tags' => 'nullable|string|max:500'
        ]);

        $data = $request->except(['images', 'image']);
        $data['slug'] = Str::slug($request->name);
        
        // Handle checkboxes properly - if not present, set to false
        $data['is_active'] = $request->has('is_active') ? true : false;
        $data['is_out_of_stock'] = $request->has('is_out_of_stock') ? true : false;
        
        // Handle legacy single image upload for backward compatibility
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/products'), $imageName);
            $data['image'] = $imageName;
        }

        $product = Product::create($data);

        // Handle multiple image uploads
        if ($request->hasFile('images')) {
            $product->addImages($request->file('images'));
        }

        return redirect()->route('admin.products.index')
            ->with('success', 'Product created successfully.');
    }

    public function show(Product $product)
    {
        $product->load('category');
        return view('admin.products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        $categories = Category::where('is_active', true)
            ->with('parent')
            ->orderBy('name')
            ->get(); 
        $product->load('images');
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock_quantity' => 'nullable|integer|min:0',
            'sku' => 'required|string|unique:products,sku,' . $product->id,
            'weight' => 'nullable|string|max:255',
            'category_id' => 'nullable|exists:categories,id',
            'images' => 'nullable|array|max:5',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_active' => 'boolean',
            'rating' => 'nullable|numeric|min:0|max:5',
            'is_out_of_stock' => 'boolean',
            'tags' => 'nullable|string|max:500'
        ]);

        $data = $request->except(['images', 'image']);
        $data['slug'] = Str::slug($request->name);
        
        // Handle checkboxes properly - if not present, set to false
        $data['is_active'] = $request->has('is_active') ? true : false;
        $data['is_out_of_stock'] = $request->has('is_out_of_stock') ? true : false;
        
        // Handle legacy single image upload for backward compatibility
        if ($request->hasFile('image')) {
            if ($product->image) {
                $oldImagePath = public_path('images/products/' . $product->image);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }
            
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/products'), $imageName);
            $data['image'] = $imageName;
        }

        $product->update($data);

        // Handle multiple image uploads
        if ($request->hasFile('images')) {
            $product->addImages($request->file('images'));
        }

        return redirect()->route('admin.products.index')
            ->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        // Delete all product images
        foreach ($product->images as $productImage) {
            $imagePath = public_path('images/products/' . $productImage->image_path);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
            $productImage->delete();
        }

        // Delete legacy single image if exists
        if ($product->image) {
            $imagePath = public_path('images/products/' . $product->image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        $product->delete();

        return redirect()->route('admin.products.index')
            ->with('success', 'Product deleted successfully.');
    }

    public function removeImage(Product $product, $imageId)
    {
        $productImage = $product->images()->find($imageId);
        if ($productImage) {
            $wasPrimary = $productImage->is_primary;
            
            if ($product->removeImage($imageId)) {
                $response = ['success' => true, 'message' => 'Image removed successfully'];
                
                // If we removed the primary image and a new one was assigned, include that info
                if ($wasPrimary) {
                    $newPrimary = $product->primaryImage;
                    if ($newPrimary) {
                        $response['new_primary'] = [
                            'id' => $newPrimary->id,
                            'image_url' => $newPrimary->image_url
                        ];
                        $response['message'] = 'Primary image removed and new primary image assigned automatically';
                    }
                }
                
                return response()->json($response);
            }
        }
        return response()->json(['success' => false, 'message' => 'Image not found'], 404);
    }

    public function setPrimaryImage(Product $product, $imageId)
    {
        if ($product->setPrimaryImage($imageId)) {
            return response()->json(['success' => true, 'message' => 'Primary image set successfully']);
        }
        return response()->json(['success' => false, 'message' => 'Image not found'], 404);
    }

    public function details(Product $product)
    {
        $product->load('category.parent', 'images');
        
        $images = [];
        foreach ($product->images as $image) {
            $images[] = [
                'id' => $image->id,
                'url' => $image->image_url,
                'path' => $image->image_path,
                'is_primary' => $image->is_primary,
                'sort_order' => $image->sort_order
            ];
        }
        
        // Build category hierarchy display
        $categoryDisplay = $product->category ? 
            ($product->category->parent ? $product->category->parent->name . ' > ' : '') . $product->category->name 
            : 'Uncategorized';
        
        return response()->json([
            'id' => $product->id,
            'name' => $product->name,
            'sku' => $product->sku,
            'price' => $product->price,
            'weight' => $product->weight,
            'category_name' => $product->category?->name,
            'category_display' => $categoryDisplay,
            'is_active' => $product->is_active,
            'description' => $product->description,
            'tags' => $product->tags,
            'parsed_tags' => $product->parsed_tags,
            'image' => $product->image, // Legacy single image
            'images' => $images, // New multiple images
            'created_at' => $product->created_at->format('M d, Y H:i'),
            'updated_at' => $product->updated_at->format('M d, Y H:i'),
            'rating' => $product->rating,
            'is_out_of_stock' => $product->is_out_of_stock,
            'stock_status_badge' => $product->stock_status_badge
        ]);
    }
    public function toggleStock(Request $request, Product $product)
    {
        try {
            $product->is_out_of_stock = $request->boolean('is_out_of_stock');
            $success = $product->save();

            return response()->json([
                'success' => $success,
                'is_out_of_stock' => $product->is_out_of_stock,
                'message' => $success ? 'Status updated' : 'Save failed'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
