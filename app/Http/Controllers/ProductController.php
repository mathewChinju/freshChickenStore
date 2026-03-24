<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Order;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with('images', 'category')->where('is_active', true);
        
        // Search functionality
        if ($request->has('search') && !empty($request->search)) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('name', 'LIKE', '%' . $searchTerm . '%')
                  ->orWhere('description', 'LIKE', '%' . $searchTerm . '%')
                  ->orWhere('sku', 'LIKE', '%' . $searchTerm . '%')
                  ->orWhere('categories', 'LIKE', '%' . $searchTerm . '%')
                  ->orWhereHas('category', function($categoryQuery) use ($searchTerm) {
                      $categoryQuery->where('name', 'LIKE', '%' . $searchTerm . '%');
                  });
            });
        }
        
        $products = $query->latest()->paginate(9);
        
        // Preserve query parameters in pagination links
        $products->appends($request->query());
        
        return view('products.index', compact('products'));
    }

    public function productsPage(Request $request)
    {
        $query = Product::with('images', 'category')->where('is_active', true);
        
        // Search functionality
        if ($request->has('search') && !empty($request->search)) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('name', 'LIKE', '%' . $searchTerm . '%')
                  ->orWhere('description', 'LIKE', '%' . $searchTerm . '%')
                  ->orWhere('sku', 'LIKE', '%' . $searchTerm . '%')
                  ->orWhere('categories', 'LIKE', '%' . $searchTerm . '%')
                  ->orWhereHas('category', function($categoryQuery) use ($searchTerm) {
                      $categoryQuery->where('name', 'LIKE', '%' . $searchTerm . '%');
                  });
            });
        }
        
        // Legacy filter functionality
        if ($request->has('filter') && !empty($request->filter)) {
            $filter = $request->filter;
            switch ($filter) {
                case 'chicken':
                    $query->where(function($q) {
                        $q->where('categories', 'LIKE', '%chicken%')
                          ->orWhereHas('category', function($categoryQuery) {
                              $categoryQuery->where('name', 'LIKE', '%chicken%');
                          });
                    });
                    break;
                case 'beef':
                    $query->where(function($q) {
                        $q->where('categories', 'LIKE', '%beef%')
                          ->orWhereHas('category', function($categoryQuery) {
                              $categoryQuery->where('name', 'LIKE', '%beef%');
                          });
                    });
                    break;
                case 'vegetables':
                    $query->where(function($q) {
                        $q->where('categories', 'LIKE', '%vegetables%')
                          ->orWhereHas('category', function($categoryQuery) {
                              $categoryQuery->where('name', 'LIKE', '%vegetables%');
                          });
                    });
                    break;
                case 'all':
                default:
                    // No filter applied, show all products
                    break;
            }
        }
        
        // Sort functionality
        $sortBy = $request->get('sort', 'featured');
        switch ($sortBy) {
            case 'price-low':
                $query->orderBy('price', 'asc');
                break;
            case 'price-high':
                $query->orderBy('price', 'desc');
                break;
            case 'name-az':
                $query->orderBy('name', 'asc');
                break;
            case 'newest':
                $query->orderBy('created_at', 'desc');
                break;
            case 'featured':
            default:
                $query->orderBy('is_featured', 'desc')
                       ->orderBy('created_at', 'desc');
                break;
        }
        
        $products = $query->paginate(9);
        
        // Preserve query parameters in pagination links
        $products->appends($request->query());
        
        return view('products.products', compact('products'));
    }

    public function show(Product $product)
    {
        $product->load('images', 'category');
        
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->where('is_active', true)
            ->take(4)
            ->get();
            
        return view('products.show_fresh', compact('product', 'relatedProducts'));
    }

    public function quickView(Product $product)
    {
        $product->load('images');
        
        $images = [];
        foreach ($product->images as $image) {
            $images[] = [
                'url' => $image->image_url,
                'is_primary' => $image->is_primary,
                'sort_order' => $image->sort_order
            ];
        }
        
        return response()->json([
            'id' => $product->id,
            'name' => $product->name,
            'description' => $product->description,
            'price' => $product->price,
            'sku' => $product->sku,
            'stock_quantity' => $product->stock_quantity,
            'image' => $product->image ? asset('images/products/' . $product->image) : null,
            'images' => $images,
            'show_url' => route('products.show', $product),
            'whatsapp_url' => route('products.whatsapp', $product),
            'categories' => $product->categories,
            'weight' => $product->weight,
            'is_featured' => $product->is_featured
        ]);
    }

    public function inquiry(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:20',
            'quantity' => 'required|integer|min:1',
            'message' => 'nullable|string',
            'whatsapp_number' => 'nullable|string|max:20'
        ]);

        // Check if sufficient stock is available
        if ($product->stock_quantity < $request->quantity) {
            return redirect()->back()
                ->with('error', "Insufficient stock. Only {$product->stock_quantity} units available.")
                ->withInput();
        }

        $totalPrice = $product->price * $request->quantity;

        Order::create([
            'product_id' => $product->id,
            'customer_name' => $request->name,
            'customer_email' => $request->email,
            'customer_phone' => $request->phone,
            'customer_address' => $request->customer_address,
            'quantity' => $request->quantity,
            'stock_at_order_time' => $product->stock_quantity,
            'unit_price' => $product->price,
            'total_price' => $totalPrice,
            'notes' => $request->message,
            'whatsapp_number' => $request->whatsapp_number,
            'is_whatsapp_inquiry' => $request->whatsapp_number ? true : false,
            'status' => 'pending'
        ]);

        // Reduce product stock
        $product->decrement('stock_quantity', $request->quantity);

        return redirect()->back()
            ->with('success', 'Your order has been submitted successfully! We will contact you soon.');
    }

    public function whatsappInquiry(Product $product)
    {
        $phoneNumber = config('app.whatsapp_number', '+918867141477');
        
        // Get the proper image URL for WhatsApp
        $imageUrl = $product->image ? url('images/products/' . $product->image) : 'No image available';
        
        $message = " Hi, I'm interested in your product: \n\n";
        // $message = "{$imageUrl}\n\n";
        $message .= "{$product->name}\n";
        $message .= "Code: {$product->sku}\n";
        $message .= "Price: \${$product->price}";
        
        // Clean the phone number - remove any +, spaces, or special characters
        $cleanPhoneNumber = preg_replace('/[^0-9]/', '', $phoneNumber);
        
        $whatsappUrl = "https://wa.me/{$cleanPhoneNumber}?text=" . urlencode($message);
        
        return redirect($whatsappUrl);
    }
}
