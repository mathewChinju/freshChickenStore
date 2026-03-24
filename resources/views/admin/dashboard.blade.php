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
    <div class="col-lg-3 col-md-6 mb-4">
        <div class="stat-card stat-card-primary">
            <div class="stat-card-icon">
                <i class="fas fa-box"></i>
            </div>
            <div class="stat-card-content">
                <div class="stat-card-number">{{ \App\Models\Product::count() }}</div>
                <div class="stat-card-label">Total Products</div>
                <div class="stat-card-change">
                    <i class="fas fa-arrow-up"></i>
                    <span>Active inventory</span>
                </div>
            </div>
            <div class="stat-card-action">
                <a href="{{ route('admin.products.index') }}" class="btn-action">
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>
    
    <div class="col-lg-3 col-md-6 mb-4">
        <div class="stat-card stat-card-success">
            <div class="stat-card-icon">
                <i class="fas fa-shopping-cart"></i>
            </div>
            <div class="stat-card-content">
                <div class="stat-card-number">{{ \App\Models\Order::count() }}</div>
                <div class="stat-card-label">Total Orders</div>
                <div class="stat-card-change">
                    <i class="fas fa-chart-line"></i>
                    <span>All time sales</span>
                </div>
            </div>
            <div class="stat-card-action">
                <a href="{{ route('admin.orders.index') }}" class="btn-action">
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>
    
    <div class="col-lg-3 col-md-6 mb-4">
        <div class="stat-card stat-card-warning">
            <div class="stat-card-icon">
                <i class="fas fa-clock"></i>
            </div>
            <div class="stat-card-content">
                <div class="stat-card-number">{{ \App\Models\Order::where('status', 'pending')->count() }}</div>
                <div class="stat-card-label">Pending Orders</div>
                <div class="stat-card-change">
                    <i class="fas fa-exclamation-triangle"></i>
                    <span>Need attention</span>
                </div>
            </div>
            <div class="stat-card-action">
                <a href="{{ route('admin.orders.index') . '?status=pending' }}" class="btn-action">
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>
    
    <div class="col-lg-3 col-md-6 mb-4">
        <div class="stat-card stat-card-info">
            <div class="stat-card-icon">
                <i class="fab fa-whatsapp"></i>
            </div>
            <div class="stat-card-content">
                <div class="stat-card-number">{{ \App\Models\Order::where('is_whatsapp_inquiry', true)->count() }}</div>
                <div class="stat-card-label">WhatsApp Inquiries</div>
                <div class="stat-card-change">
                    <i class="fas fa-comments"></i>
                    <span>Social orders</span>
                </div>
            </div>
            <div class="stat-card-action">
                <a href="{{ route('admin.orders.index') . '?whatsapp=1' }}" class="btn-action">
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Recent Orders and Quick Actions -->
<div class="row">
    <div class="col-lg-8 mb-4">
        <div class="content-card">
            <div class="content-card-header">
                <h5 class="content-card-title">
                    <i class="fas fa-receipt me-2"></i>Recent Orders
                </h5>
                <a href="{{ route('admin.orders.index') }}" class="btn btn-sm btn-outline-primary">
                    View All
                </a>
            </div>
            <div class="content-card-body">
                @php
                    $recentOrders = \App\Models\Order::with('product')->latest()->take(5)->get();
                @endphp
                @if($recentOrders->count() > 0)
                    <div class="table-responsive">
                        <table class="modern-table">
                            <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>Customer</th>
                                    <th>Product</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentOrders as $order)
                                    <tr>
                                        <td>
                                            <span class="order-id">#{{ $order->id }}</span>
                                        </td>
                                        <td>
                                            <div class="customer-info">
                                                <div class="customer-name">{{ $order->customer_name }}</div>
                                                <div class="customer-email small text-muted">{{ $order->customer_email ?? 'N/A' }}</div>
                                            </div>
                                        </td>
                                        <td>
                                            @if($order->product)
                                                <div class="product-info">
                                                    <div class="product-name">{{ $order->product->name }}</div>
                                                    <div class="product-price small text-muted">₹{{ number_format($order->product->price, 2) }}</div>
                                                </div>
                                            @else
                                                <span class="text-muted">Product deleted</span>
                                            @endif
                                        </td>
                                        <td>
                                            <span class="status-badge status-{{ $order->status }}">
                                                {{ ucfirst($order->status) }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="order-date small text-muted">
                                                {{ $order->created_at->format('M j, Y') }}
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="empty-state">
                        <i class="fas fa-shopping-cart empty-icon"></i>
                        <h6>No orders yet</h6>
                        <p class="text-muted">Your first order will appear here</p>
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
                    
                    <a href="{{ route('admin.orders.create') }}" class="quick-action-btn quick-action-success">
                        <div class="quick-action-icon">
                            <i class="fas fa-plus"></i>
                        </div>
                        <div class="quick-action-content">
                            <div class="quick-action-title">Create Order</div>
                            <div class="quick-action-desc">Manual entry</div>
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
                    
                    <a href="{{ route('admin.orders.index') }}" class="quick-action-btn quick-action-outline">
                        <div class="quick-action-icon">
                            <i class="fas fa-shopping-cart"></i>
                        </div>
                        <div class="quick-action-content">
                            <div class="quick-action-title">Manage Orders</div>
                            <div class="quick-action-desc">View all orders</div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
