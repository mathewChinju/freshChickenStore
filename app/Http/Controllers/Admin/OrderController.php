<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function index(Request $request)
    {
        $query = Order::with('product');
        
        // Search filter
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('customer_name', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('customer_email', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('customer_phone', 'LIKE', "%{$searchTerm}%")
                  ->orWhereHas('product', function($pq) use ($searchTerm) {
                      $pq->where('name', 'LIKE', "%{$searchTerm}%");
                  });
            });
        }
        
        // Product filter
        if ($request->filled('product_id')) {
            $query->where('product_id', $request->product_id);
        }
        
        // Status filter
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        
        // Date range filter
        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }
        
        // Sort filter
        $sortField = $request->get('sort', 'created_at');
        $sortDirection = 'desc';
        
        switch ($sortField) {
            case 'customer_name':
                $query->orderBy('customer_name', 'asc');
                break;
            case 'total_price':
                $query->orderBy('total_price', 'desc');
                break;
            case 'created_at':
            default:
                $query->orderBy('created_at', 'desc');
                break;
        }
        
        $orders = $query->paginate(10)->withQueryString();
        
        return view('admin.orders.index', compact('orders'));
    }

    public function create()
    {
        return view('admin.orders.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email',
            'customer_phone' => 'required|string|max:20',
            'customer_address' => 'nullable|string',
            'quantity' => 'required|integer|min:1',
            'notes' => 'nullable|string',
            'whatsapp_number' => 'nullable|string|max:20',
            'is_whatsapp_inquiry' => 'boolean'
        ]);

        $product = \App\Models\Product::findOrFail($request->product_id);
        
        // Check if sufficient stock is available
        if ($product->stock_quantity < $request->quantity) {
            return redirect()->back()
                ->with('error', "Insufficient stock. Only {$product->stock_quantity} units available.")
                ->withInput();
        }

        $totalPrice = $product->price * $request->quantity;

        $data = $request->all();
        $data['total_price'] = $totalPrice;
        $data['stock_at_order_time'] = $product->stock_quantity;
        $data['unit_price'] = $product->price;
        $data['status'] = 'pending';

        // Create the order
        $order = Order::create($data);

        // Reduce product stock
        $product->decrement('stock_quantity', $request->quantity);

        return redirect()->route('admin.orders.index')
            ->with('success', 'Order created successfully. Stock updated.');
    }

    public function show(Order $order)
    {
        $order->load('product');
        return view('admin.orders.show', compact('order'));
    }

    public function edit(Order $order)
    {
        $order->load('product');
        return view('admin.orders.edit', compact('order'));
    }

    public function update(Request $request, Order $order)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email',
            'customer_phone' => 'required|string|max:20',
            'customer_address' => 'nullable|string',
            'quantity' => 'required|integer|min:1',
            'status' => 'required|in:pending,confirmed,processing,shipped,delivered,cancelled',
            'notes' => 'nullable|string',
            'whatsapp_number' => 'nullable|string|max:20',
            'is_whatsapp_inquiry' => 'boolean'
        ]);

        $product = \App\Models\Product::findOrFail($request->product_id);
        $oldQuantity = $order->quantity;
        $newQuantity = $request->quantity;
        
        // Handle product change
        if ($order->product_id != $request->product_id) {
            // Restore stock for old product
            $oldProduct = \App\Models\Product::findOrFail($order->product_id);
            $oldProduct->increment('stock_quantity', $oldQuantity);
            
            // Check stock for new product
            if ($product->stock_quantity < $newQuantity) {
                return redirect()->back()
                    ->with('error', "Insufficient stock. Only {$product->stock_quantity} units available.")
                    ->withInput();
            }
            
            // Reduce stock for new product
            $product->decrement('stock_quantity', $newQuantity);
        } else {
            // Same product, handle quantity change
            if ($newQuantity > $oldQuantity) {
                $difference = $newQuantity - $oldQuantity;
                if ($product->stock_quantity < $difference) {
                    return redirect()->back()
                        ->with('error', "Insufficient stock. Only {$product->stock_quantity} units available.")
                        ->withInput();
                }
                $product->decrement('stock_quantity', $difference);
            } elseif ($newQuantity < $oldQuantity) {
                $difference = $oldQuantity - $newQuantity;
                $product->increment('stock_quantity', $difference);
            }
        }

        $totalPrice = $product->price * $newQuantity;

        $data = $request->all();
        $data['total_price'] = $totalPrice;

        $order->update($data);

        return redirect()->route('admin.orders.index')
            ->with('success', 'Order updated successfully. Stock adjusted.');
    }

    public function destroy(Order $order)
    {
        // Restore stock to product before deleting order
        if ($order->product) {
            $order->product->increment('stock_quantity', $order->quantity);
        }

        $order->delete();

        return redirect()->route('admin.orders.index')
            ->with('success', 'Order deleted successfully. Stock restored.');
    }

    public function details(Order $order)
    {
        $order->load(['product']);
        
        return response()->json([
            'id' => $order->id,
            'customer_name' => $order->customer_name,
            'customer_email' => $order->customer_email,
            'customer_phone' => $order->customer_phone,
            'customer_address' => $order->customer_address,
            'product_name' => $order->product?->name,
            'product_sku' => $order->product?->sku,
            'product_price' => $order->product?->price,
            'product_image' => $order->product?->image,
            'quantity' => $order->quantity,
            'unit_price' => $order->unit_price,
            'total_price' => $order->total_price,
            'status' => $order->status,
            'notes' => $order->notes,
            'created_at' => $order->created_at->format('M j, Y g:i A'),
            'updated_at' => $order->updated_at->format('M j, Y g:i A'),
            'is_whatsapp_inquiry' => $order->is_whatsapp_inquiry,
            'whatsapp_number' => $order->whatsapp_number,
        ]);
    }

    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending,confirmed,processing,shipped,delivered,cancelled'
        ]);

        $oldStatus = $order->status;
        $newStatus = $request->status;

        // Handle stock restoration when order is cancelled
        if ($oldStatus != 'cancelled' && $newStatus == 'cancelled') {
            if ($order->product) {
                $order->product->increment('stock_quantity', $order->quantity);
            }
        }
        // Handle stock deduction when order is un-cancelled
        elseif ($oldStatus == 'cancelled' && $newStatus != 'cancelled') {
            if ($order->product && $order->product->stock_quantity >= $order->quantity) {
                $order->product->decrement('stock_quantity', $order->quantity);
            } else {
                return redirect()->back()
                    ->with('error', 'Cannot un-cancel order. Insufficient stock available.')
                    ->withInput();
            }
        }

        $order->update(['status' => $newStatus]);

        return redirect()->back()
            ->with('success', 'Order status updated successfully.');
    }
}
