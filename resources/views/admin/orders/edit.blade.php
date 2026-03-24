@extends('layouts.admin')

@section('title', 'Edit Order - Admin Panel')
@section('page-title', '')

@section('content')
<div class="container-standard">
    <div class="card-standard">
        <div class="card-header-standard">
            <div class="header-left">
                <h4 class="card-title-standard">
                    <i class="fas fa-edit me-2"></i>Edit Order
                </h4>
                <p class="card-subtitle-standard">Update order information: #{{ $order->id }}</p>
            </div>
            <div class="header-right">
                <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-1"></i>Back to Orders
                </a>
            </div>
        </div>
        <div class="card-body-standard">
            <form action="{{ route('admin.orders.update', $order) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="form-grid">
                    <!-- Product Selection -->
                    <div class="form-group-full">
                        <label for="product_id" class="form-label-standard">
                            Product <span class="required">*</span>
                        </label>
                        <select class="form-control-standard @error('product_id') is-invalid @enderror" 
                                id="product_id" name="product_id" required>
                            <option value="">Select a product</option>
                            @foreach(\App\Models\Product::where('is_active', true)->orderBy('name')->get() as $product)
                                <option value="{{ $product->id }}" {{ old('product_id', $order->product_id) == $product->id ? 'selected' : '' }}>
                                    {{ $product->name }} - ${{ number_format($product->price, 2) }}
                                </option>
                            @endforeach
                        </select>
                        @error('product_id')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Customer Information Row -->
                    <div class="form-row">
                        <div class="form-group-half">
                            <label for="customer_name" class="form-label-standard">
                                Customer Name <span class="required">*</span>
                            </label>
                            <input type="text" 
                                   class="form-control-standard @error('customer_name') is-invalid @enderror" 
                                   id="customer_name" 
                                   name="customer_name" 
                                   value="{{ old('customer_name', $order->customer_name) }}" 
                                   placeholder="Enter customer name"
                                   required>
                            @error('customer_name')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group-half">
                            <label for="customer_email" class="form-label-standard">
                                Customer Email
                            </label>
                            <input type="email" 
                                   class="form-control-standard @error('customer_email') is-invalid @enderror" 
                                   id="customer_email" 
                                   name="customer_email" 
                                   value="{{ old('customer_email', $order->customer_email) }}" 
                                   placeholder="customer@example.com">
                            @error('customer_email')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Order Details Row -->
                    <div class="form-row">
                        <div class="form-group-half">
                            <label for="quantity" class="form-label-standard">
                                Quantity <span class="required">*</span>
                            </label>
                            <input type="number" 
                                   class="form-control-standard @error('quantity') is-invalid @enderror" 
                                   id="quantity" 
                                   name="quantity" 
                                   min="1" 
                                   value="{{ old('quantity', $order->quantity) }}" 
                                   placeholder="1"
                                   required>
                            @error('quantity')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group-half">
                            <label for="customer_phone" class="form-label-standard">
                                Customer Phone
                            </label>
                            <input type="tel" 
                                   class="form-control-standard @error('customer_phone') is-invalid @enderror" 
                                   id="customer_phone" 
                                   name="customer_phone" 
                                   value="{{ old('customer_phone', $order->customer_phone) }}" 
                                   placeholder="+1 234 567 8900">
                            @error('customer_phone')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Customer Address -->
                    <div class="form-group-full">
                        <label for="customer_address" class="form-label-standard">
                            Customer Address
                        </label>
                        <textarea class="form-control-standard @error('customer_address') is-invalid @enderror" 
                                  id="customer_address" 
                                  name="customer_address" 
                                  rows="3" 
                                  placeholder="Enter customer address">{{ old('customer_address', $order->customer_address) }}</textarea>
                        @error('customer_address')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Order Status -->
                    <div class="form-group-full">
                        <label for="status" class="form-label-standard">
                            Order Status
                        </label>
                        <select class="form-control-standard @error('status') is-invalid @enderror" 
                                id="status" name="status">
                            <option value="pending" {{ old('status', $order->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="processing" {{ old('status') == 'processing' ? 'selected' : '' }}>Processing</option>
                            <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                            <option value="cancelled" {{ old('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                        @error('status')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Notes -->
                    <div class="form-group-full">
                        <label for="notes" class="form-label-standard">
                            Order Notes
                        </label>
                        <textarea class="form-control-standard @error('notes') is-invalid @enderror" 
                                  id="notes" 
                                  name="notes" 
                                  rows="4" 
                                  placeholder="Add any notes about this order">{{ old('notes', $order->notes) }}</textarea>
                        @error('notes')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-2"></i>Update Order
                    </button>
                    <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times me-2"></i>Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

