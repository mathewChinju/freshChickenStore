@extends('layouts.admin')

@section('title', 'Admin Dashboard - Kitchen & Meat Store')
@section('page-title', '')

@section('content')
<!-- Welcome Section -->
 <!-- <div class="welcome-section mb-4">
    <div class="row align-items-center">
        <div class="col-md-8">
            <h1 class="welcome-title">Welcome back, {{ Auth::user()->name }}!</h1>
            <p class="welcome-subtitle">Here's what's happening with your store today</p>
        </div>
        <div class="col-md-4 text-md-end mt-3 mt-md-0">
            <div class="date-info">
                <i class="fas fa-calendar-alt me-2"></i>
                {{ now()->format('l, F j, Y') }}
            </div>
        </div>
    </div>
</div>    -->

<!-- Statistics Cards -->
<div class="row mb-4">
    <div class="col-lg-4 col-md-6 mb-4">
        <div class="stat-card stat-card-info">
            <div class="stat-card-icon">
                <i class="fas fa-cubes"></i>
            </div>
            <div class="stat-card-content">
                <div class="stat-card-number">{{ \App\Models\Product::count() }}</div>
                <div class="stat-card-label">Total Products</div>
                <div class="stat-card-change">
                    <i class="fas fa-arrow-up"></i>
                    <span>Total products in store</span>
                </div>
            </div>
            <div class="stat-card-action">
                <a href="{{ route('admin.products.index') }}" class="btn-action">
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>
    
    <div class="col-lg-4 col-md-6 mb-4">
        <div class="stat-card stat-card-success">
            <div class="stat-card-icon">
                <i class="fas fa-layer-group"></i>
            </div>
            <div class="stat-card-content">
                <div class="stat-card-number">{{ \App\Models\Category::count() }}</div>
                <div class="stat-card-label">Categories</div>
                <div class="stat-card-change">
                    <i class="fas fa-folder"></i>
                    <span>Product categories</span>
                </div>
            </div>
            <div class="stat-card-action">
                <a href="{{ route('admin.categories.index') }}" class="btn-action">
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>
    
    <div class="col-lg-4 col-md-6 mb-4">
        <div class="stat-card stat-card-warning">
            <div class="stat-card-icon">
                <i class="fas fa-check-circle"></i>
            </div>
            <div class="stat-card-content">
                <div class="stat-card-number">{{ \App\Models\Product::where('is_active', true)->count() }}</div>
                <div class="stat-card-label">Active Products</div>
                <div class="stat-card-change">
                    <i class="fas fa-arrow-up"></i>
                    <span>Currently active</span>
                </div>
            </div>
            <div class="stat-card-action">
                <a href="{{ route('admin.products.index') }}?filter=active" class="btn-action">
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>
    
    {{-- <div class="col-lg-4 col-md-6 mb-4">
        <div class="stat-card stat-card-primary">
            <div class="stat-card-icon">
                <i class="fas fa-box"></i>
            </div>
            <div class="stat-card-content">
                <div class="stat-card-number">{{ \App\Models\Product::where('stock_quantity', '>', 0)->where('is_active', true)->count() }}</div>
                <div class="stat-card-label">In-Stock Products</div>
                <div class="stat-card-change">
                    <i class="fas fa-check-circle"></i>
                    <span>Available for sale</span>
                </div>
            </div>
            <div class="stat-card-action">
                <a href="{{ route('admin.products.index') }}?stock=available" class="btn-action">
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </div> --}}
</div>

<!-- Recent Products and Quick Actions -->
<div class="row">
    <div class="col-lg-8 mb-4">
        <div class="content-card">
            <div class="content-card-header">
                <h5 class="content-card-title">
                    <i class="fas fa-box me-2"></i>Recent Products
                </h5>
                <a href="{{ route('admin.products.index') }}" class="btn btn-sm btn-outline-primary">
                    View All
                </a>
            </div>
            <div class="content-card-body">
                @php
                    $recentProducts = \App\Models\Product::with('category')->latest()->take(5)->get();
                @endphp
                @if($recentProducts->count() > 0)
                    <div class="table-responsive">
                        <table class="modern-table">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Category</th>
                                    <th>Price</th>
                                    <th>Stock</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentProducts as $product)
                                    <tr>
                                        <td>
                                            <div class="product-info">
                                                <div class="product-name">{{ $product->name }}</div>
                                                <div class="product-sku small text-muted">{{ $product->sku ?? 'N/A' }}</div>
                                            </div>
                                        </td>
                                        <td>
                                            @if($product->category)
                                                <span class="category-badge">{{ $product->category->name }}</span>
                                            @else
                                                <span class="text-muted">No category</span>
                                            @endif
                                        </td>
                                        <td>
                                            <span class="price">${{ number_format($product->price, 2) }}</span>
                                        </td>
                                        <td>
                                            <span class="stock-badge {{ $product->stock_quantity > 0 ? 'in-stock' : 'out-of-stock' }}">
                                                {{ $product->stock_quantity }} units
                                            </span>
                                        </td>
                                        <td>
                                            <span class="status-badge status-{{ $product->stock_quantity > 0 ? 'active' : 'inactive' }}">
                                                {{ $product->stock_quantity > 0 ? 'Available' : 'Out of Stock' }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="empty-state">
                        <i class="fas fa-box empty-icon"></i>
                        <h6>No products yet</h6>
                        <p class="text-muted">Your first product will appear here</p>
                        <a href="{{ route('admin.products.create') }}" class="btn btn-primary mt-2">
                            <i class="fas fa-plus me-2"></i>Add Product
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
    
    <div class="col-lg-4 mb-4">
        <div class="content-card">
            <div class="content-card-header">
                <h5 class="content-card-title">
                    <i class="fas fa-bolt me-2"></i>Quick Actions
                </h5>
            </div>
            <div class="content-card-body">
                <div class="quick-actions">
                    <a href="{{ route('admin.products.create') }}" class="quick-action-btn quick-action-primary">
                        <div class="quick-action-icon">
                            <i class="fas fa-plus"></i>
                        </div>
                        <div class="quick-action-content">
                            <div class="quick-action-title">Add Product</div>
                            <div class="quick-action-desc">List new items</div>
                        </div>
                    </a>
                    
                    <a href="{{ route('admin.categories.create') }}" class="quick-action-btn quick-action-success">
                        <div class="quick-action-icon">
                            <i class="fas fa-plus"></i>
                        </div>
                        <div class="quick-action-content">
                            <div class="quick-action-title">Add Category</div>
                            <div class="quick-action-desc">Organize products</div>
                        </div>
                    </a>
                    
                    <a href="{{ route('admin.products.index') }}" class="quick-action-btn quick-action-outline">
                        <div class="quick-action-icon">
                            <i class="fas fa-box"></i>
                        </div>
                        <div class="quick-action-content">
                            <div class="quick-action-title">Manage Products</div>
                            <div class="quick-action-desc">View inventory</div>
                        </div>
                    </a>
                    
                    <a href="{{ route('admin.categories.index') }}" class="quick-action-btn quick-action-outline">
                        <div class="quick-action-icon">
                            <i class="fas fa-layer-group"></i>
                        </div>
                        <div class="quick-action-content">
                            <div class="quick-action-title">Manage Categories</div>
                            <div class="quick-action-desc">View categories</div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
