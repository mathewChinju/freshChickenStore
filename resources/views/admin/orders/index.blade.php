@extends('layouts.admin')

@section('title', 'Orders - Admin Panel')
@section('page-title', '')

@section('content')
<!-- Orders Header -->
<div class="content-card mb-4">
    <div class="content-card-header">
        <h5 class="content-card-title">
            <i class="fas fa-shopping-cart me-2"></i>Orders
            <span class="badge bg-secondary ms-2">{{ $orders->total() }} total</span>
        </h5>
        <a href="{{ route('admin.orders.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i>Create Order
        </a>
    </div>
    <div class="content-card-body">
        <!-- Filters Section -->
        <div class="filters-section">
            <form id="orderFiltersForm" method="GET" action="{{ route('admin.orders.index') }}">
                <div class="row g-3">
                    <div class="col-md-3">
                        <label class="form-label">
                            <i class="fas fa-search me-2"></i>Search
                        </label>
                        <input type="text" 
                               class="form-control" 
                               name="search" 
                               value="{{ request('search') }}" 
                               placeholder="Search orders..."
                               id="searchInput">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">
                            <i class="fas fa-folder me-2"></i>Product
                        </label>
                        <select class="form-select" name="product_id" id="productFilter">
                            <option value="">All Products</option>
                            @foreach(\App\Models\Product::where('is_active', true)->orderBy('name')->get() as $product)
                                <option value="{{ $product->id }}" 
                                        {{ request('product_id') == $product->id ? 'selected' : '' }}>
                                    {{ $product->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">
                            <i class="fas fa-toggle-on me-2"></i>Status
                        </label>
                        <select class="form-select" name="status" id="statusFilter">
                            <option value="">All Status</option>
                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="processing" {{ request('status') == 'processing' ? 'selected' : '' }}>Processing</option>
                            <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                            <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">
                            <i class="fas fa-sort me-2"></i>Sort By
                        </label>
                        <select class="form-select" name="sort" id="sortFilter">
                            <option value="">Default</option>
                            <option value="created_at" {{ request('sort') == 'created_at' ? 'selected' : '' }}>Date Created</option>
                            <option value="total_price" {{ request('sort') == 'total_price' ? 'selected' : '' }}>Total Price</option>
                            <option value="customer_name" {{ request('sort') == 'customer_name' ? 'selected' : '' }}>Customer Name</option>
                        </select>
                    </div>
                    <div class="col-md-1">
                        <label class="form-label">
                            <i class="fas fa-calendar-alt me-2"></i>From
                        </label>
                        <input type="date" 
                               class="form-control" 
                               name="date_from" 
                               value="{{ request('date_from') }}"
                               id="dateFrom">
                    </div>
                    <div class="col-md-1">
                        <label class="form-label">
                            <i class="fas fa-calendar-alt me-2"></i>To
                        </label>
                        <input type="date" 
                               class="form-control" 
                               name="date_to" 
                               value="{{ request('date_to') }}"
                               id="dateTo">
                    </div>
                    <div class="col-md-1 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary me-2" data-tooltip="Apply Filters">
                            <i class="fas fa-filter"></i>
                        </button>
                        <a href="{{ route('admin.orders.index') }}" class="btn btn-outline-secondary" data-tooltip="Clear Filters">
                            <i class="fas fa-times"></i>
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
        <!-- Orders List -->
<div class="content-card">
    <div class="content-card-body">
        @if($orders->count() > 0)
            <div class="table-responsive">
                <table class="modern-table">
                    <thead>
                        <tr>
                            <th>Order</th>
                            <th>Customer</th>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Total Price</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                            <tr>
                                <td>
                                    <div class="order-info">
                                        <div class="order-details">
                                            <div class="order-id">#{{ $order->id }}</div>
                                            <div class="order-date small text-muted">{{ $order->created_at->format('M j, Y') }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="customer-info">
                                        <div class="customer-name">{{ $order->customer_name }}</div>
                                        @if($order->customer_email)
                                            <div class="customer-email small text-muted">{{ $order->customer_email }}</div>
                                        @endif
                                        @if($order->customer_phone)
                                            <div class="customer-phone small text-muted">
                                                <i class="fas fa-phone me-1"></i>{{ $order->customer_phone }}
                                            </div>
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    @if($order->product)
                                        <div class="product-info">
                                            <div class="product-image-name">
                                                @if($order->product->image)
                                                    <img src="{{ $order->product->primary_image_url }}" 
                                                         alt="{{ $order->product->name }}" 
                                                         class="product-thumbnail">
                                                @else
                                                    <div class="product-thumbnail-placeholder">
                                                        <i class="fas fa-image"></i>
                                                    </div>
                                                @endif
                                                <div class="product-details">
                                                    <div class="product-name">{{ $order->product->name }}</div>
                                                    <div class="product-sku small text-muted">SKU: {{ $order->product->sku }}</div>
                                                    <div class="product-stock small">
                                                        {!! $order->product->stock_status_badge !!}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <span class="text-muted">Product deleted</span>
                                    @endif
                                </td>
                                <td>
                                    <span class="quantity-badge">{{ $order->quantity }}</span>
                                </td>
                                <td>
                                    <div class="order-price">
                                        <div class="unit-price">${{ number_format($order->unit_price, 2) }} × {{ $order->quantity }}</div>
                                        <div class="total-price">${{ number_format($order->total_price, 2) }}</div>
                                    </div>
                                </td>
                                <td>
                                    <span class="status-badge status-{{ $order->status }}">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </td>
                                <td>
                                    <div class="order-date small text-muted">
                                        {{ $order->created_at->format('M d, Y H:i') }}
                                    </div>
                                </td>
                                <td>
                                    <div class="action-buttons">
                                        <button type="button" 
                                                class="btn btn-sm btn-outline-primary" 
                                                onclick="showOrderDetails({{ $order->id }})"
                                                data-tooltip="View Order">
                                            <i class="fas fa-eye"></i>
                                        </button> 
                                        <a href="{{ route('admin.orders.edit', $order) }}" 
                                           class="btn btn-sm btn-outline-secondary"
                                           data-tooltip="Edit Order">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        @if($order->status !== 'cancelled')
                                         <form action="{{ route('admin.orders.update', $order) }}" 
                                              method="POST" 
                                              class="d-inline"
                                              onsubmit="return confirm('Are you sure you want to delete this order?')">
                                            @csrf
                                            @method('DELETE') 
                                            <button type="button" 
                                                    class="btn btn-sm btn-outline-danger" 
                                                    onclick="deleteOrder({{ $order->id }})"
                                                    data-tooltip="Delete Order">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form> 
                                        @endif 
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
             
            
            <!-- Simple Pagination -->
            <div class="simple-pagination">
                <div class="pagination-info">
                    Showing {{ $orders->firstItem() }} to {{ $orders->lastItem() }} of {{ $orders->total() }} orders
                </div>
                <div class="pagination-links">
                    @if($orders->hasPages())
                        <!-- First Page -->
                        @if($orders->currentPage() > 1)
                            <a href="{{ $orders->url(1) }}" class="pagination-link">
                                <i class="fas fa-angle-double-left"></i>
                            </a>
                        @else
                            <span class="pagination-link disabled">
                                <i class="fas fa-angle-double-left"></i>
                            </span>
                        @endif
                        
                        <!-- Previous Page -->
                        @if($orders->currentPage() > 1)
                            <a href="{{ $orders->url($orders->currentPage() - 1) }}" class="pagination-link">
                                <i class="fas fa-angle-left"></i>
                            </a>
                        @else
                            <span class="pagination-link disabled">
                                <i class="fas fa-angle-left"></i>
                            </span>
                        @endif
                        
                        <!-- Page Numbers -->
                        @if($orders->lastPage() <= 7)
                            @for($i = 1; $i <= $orders->lastPage(); $i++)
                                <a href="{{ $orders->url($i) }}" 
                                   class="pagination-link {{ $i == $orders->currentPage() ? 'active' : '' }}">
                                    {{ $i }}
                                </a>
                            @endfor
                        @else
                            <!-- Show current page and surrounding pages -->
                            @php
                                $start = max(1, $orders->currentPage() - 2);
                                $end = min($orders->lastPage(), $orders->currentPage() + 2);
                            @endphp
                            
                            @if($start > 1)
                                <a href="{{ $orders->url(1) }}" class="pagination-link">1</a>
                                @if($start > 2)
                                    <span class="pagination-link disabled">...</span>
                                @endif
                            @endif
                            
                            @for($i = $start; $i <= $end; $i++)
                                <a href="{{ $orders->url($i) }}" 
                                   class="pagination-link {{ $i == $orders->currentPage() ? 'active' : '' }}">
                                    {{ $i }}
                                </a>
                            @endfor
                            
                            @if($end < $orders->lastPage())
                                @if($end < $orders->lastPage() - 1)
                                    <span class="pagination-link disabled">...</span>
                                @endif
                                <a href="{{ $orders->url($orders->lastPage()) }}" class="pagination-link">{{ $orders->lastPage() }}</a>
                            @endif
                        @endif
                        
                        <!-- Next Page -->
                        @if($orders->currentPage() < $orders->lastPage())
                            <a href="{{ $orders->url($orders->currentPage() + 1) }}" class="pagination-link">
                                <i class="fas fa-angle-right"></i>
                            </a>
                        @else
                            <span class="pagination-link disabled">
                                <i class="fas fa-angle-right"></i>
                            </span>
                        @endif
                        
                        <!-- Last Page -->
                        @if($orders->currentPage() < $orders->lastPage())
                            <a href="{{ $orders->url($orders->lastPage()) }}" class="pagination-link">
                                <i class="fas fa-angle-double-right"></i>
                            </a>
                        @else
                            <span class="pagination-link disabled">
                                <i class="fas fa-angle-double-right"></i>
                            </span>
                        @endif
                    @endif
                </div>
            </div>
        @else
            <div class="empty-state">
                <i class="fas fa-shopping-cart empty-icon"></i>
                <h6>No orders found</h6>
                <p class="text-muted">
                    @if(request('search') || request('status') || request('sort'))
                        No orders match your current filters. Try adjusting your search criteria.
                    @else
                        No customer orders have been placed yet.
                    @endif
                </p>
                <a href="{{ route('admin.orders.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-2"></i>Create Order
                </a>
            </div>
        @endif
    </div>
</div>

<script>
function clearFilters() {
    window.location.href = '{{ route("admin.orders.index") }}';
}

// Auto-submit filters on change
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('orderFiltersForm');
    const searchInput = document.getElementById('searchInput');
    const productFilter = document.getElementById('productFilter');
    const statusFilter = document.getElementById('statusFilter');
    const sortFilter = document.getElementById('sortFilter');
    
    if (searchInput) {
        searchInput.addEventListener('keyup', function(e) {
            if (e.key === 'Enter') {
                form.submit();
            }
        });
    }
    
    if (productFilter) {
        productFilter.addEventListener('change', function() {
            form.submit();
        });
    }
    
    if (statusFilter) {
        statusFilter.addEventListener('change', function() {
            form.submit();
        });
    }
    
    if (sortFilter) {
        sortFilter.addEventListener('change', function() {
            form.submit();
        });
    }
});
</script>



<!-- Order View Modal -->
<div class="modal fade" id="orderViewModal" tabindex="-1" aria-labelledby="orderViewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="orderViewModalLabel">
                    <i class="fas fa-shopping-cart me-2"></i>Order Details
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <h6><i class="fas fa-info-circle me-2"></i>Order Information</h6>
                        <div class="info-grid">
                            <div class="info-item">
                                <small class="text-muted">Order ID:</small>
                                <div id="modalOrderId"></div>
                            </div>
                            <div class="info-item">
                                <small class="text-muted">Status:</small>
                                <div id="modalOrderStatus"></div>
                            </div>
                            <div class="info-item">
                                <small class="text-muted">Total Price:</small>
                                <div id="modalTotalPrice" class="fw-bold text-primary"></div>
                            </div>
                            <div class="info-item">
                                <small class="text-muted">Quantity:</small>
                                <div id="modalQuantity"></div>
                            </div>
                            <div class="info-item">
                                <small class="text-muted">Unit Price:</small>
                                <div id="modalUnitPrice"></div>
                            </div>
                            <div class="info-item">
                                <small class="text-muted">WhatsApp Inquiry:</small>
                                <div id="modalWhatsAppInquiry"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h6><i class="fas fa-user me-2"></i>Customer Information</h6>
                        <div class="info-grid">
                            <div class="info-item">
                                <small class="text-muted">Name:</small>
                                <div id="modalCustomerName"></div>
                            </div>
                            <div class="info-item">
                                <small class="text-muted">Email:</small>
                                <div id="modalCustomerEmail"></div>
                            </div>
                            <div class="info-item">
                                <small class="text-muted">Phone:</small>
                                <div id="modalCustomerPhone"></div>
                            </div>
                            <div class="info-item">
                                <small class="text-muted">WhatsApp:</small>
                                <div id="modalWhatsAppNumber"></div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="row mt-4">
                    <div class="col-md-12">
                        <h6><i class="fas fa-box me-2"></i>Product Information</h6>
                        <div class="product-info-modal">
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="product-image-container text-center mb-3">
                                        <img id="modalProductImage" src="" alt="" class="product-modal-image">
                                        <div id="modalProductImagePlaceholder" class="product-modal-placeholder" style="display: none;">
                                            <i class="fas fa-image fa-3x text-muted"></i>
                                            <p class="text-muted mt-2">No Image</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-10">
                                    <h6 id="modalProductName" class="product-modal-name"></h6>
                                    <div class="product-modal-details">
                                        <div class="detail-row">
                                            <strong>SKU:</strong>
                                            <span id="modalProductSku"></span>
                                        </div>
                                        <div class="detail-row">
                                            <strong>Price:</strong>
                                            <span id="modalProductPrice" class="text-primary fw-bold"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="row mt-4">
                    <div class="col-md-6">
                        <h6><i class="fas fa-map-marker-alt me-2"></i>Delivery Address</h6>
                        <div id="modalCustomerAddress" class="mb-3"></div>
                    </div>
                    <div class="col-md-6">
                        <h6><i class="fas fa-sticky-note me-2"></i>Order Notes</h6>
                        <div id="modalOrderNotes" class="mb-3"></div>
                    </div>
                </div>
                
                {{-- <div class="row mt-4">
                    <div class="col-md-6">
                        <h6><i class="fas fa-clock me-2"></i>Timestamps</h6>
                        <div class="info-grid">
                            <div class="info-item">
                                <small class="text-muted">Created:</small>
                                <div id="modalOrderCreated"></div>
                            </div>
                            <div class="info-item">
                                <small class="text-muted">Last Updated:</small>
                                <div id="modalOrderUpdated"></div>
                            </div>
                        </div>
                    </div>
                </div> --}}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-2"></i>Close
                </button>
                <a id="modalEditButton" href="" class="btn btn-primary">
                    <i class="fas fa-edit me-2"></i>Edit Order
                </a>
            </div>
        </div>
    </div>
</div>

<script>
 

function showOrderDetails(orderId) {
    // Show loading state
    const modal = new bootstrap.Modal(document.getElementById('orderViewModal'));
    
    // Reset modal content
    document.getElementById('modalOrderId').textContent = '#' + orderId;
    document.getElementById('modalOrderStatus').textContent = 'Loading...';
    document.getElementById('modalTotalPrice').textContent = 'Loading...';
    document.getElementById('modalQuantity').textContent = 'Loading...';
    document.getElementById('modalUnitPrice').textContent = 'Loading...';
    document.getElementById('modalWhatsAppInquiry').textContent = 'Loading...';
    document.getElementById('modalCustomerName').textContent = 'Loading...';
    document.getElementById('modalCustomerEmail').textContent = 'Loading...';
    document.getElementById('modalCustomerPhone').textContent = 'Loading...';
    document.getElementById('modalWhatsAppNumber').textContent = 'Loading...';
    document.getElementById('modalProductName').textContent = 'Loading...';
    document.getElementById('modalProductSku').textContent = 'Loading...';
    document.getElementById('modalProductPrice').textContent = 'Loading...';
    document.getElementById('modalCustomerAddress').textContent = 'Loading...';
    document.getElementById('modalOrderNotes').textContent = 'Loading...';
    // document.getElementById('modalOrderCreated').textContent = 'Loading...';
    // document.getElementById('modalOrderUpdated').textContent = 'Loading...';
    
    // Hide image and show placeholder initially
    document.getElementById('modalProductImage').style.display = 'none';
    document.getElementById('modalProductImagePlaceholder').style.display = 'block';
    
    // Update edit button
    document.getElementById('modalEditButton').href = '/admin/orders/' + orderId + '/edit';
    
    // Show modal
    modal.show();
    
    // Fetch order details via AJAX
    fetch(`/admin/orders/${orderId}/details`)
        .then(response => {
            if (!response.ok) {
                throw new Error('Order not found');
            }
            return response.json();
        })
        .then(order => {
            // Update modal content with order data
            document.getElementById('modalOrderId').textContent = '#' + order.id;
            document.getElementById('modalOrderStatus').innerHTML = getStatusBadge(order.status);
            document.getElementById('modalTotalPrice').textContent = '$' + parseFloat(order.total_price).toFixed(2);
            document.getElementById('modalQuantity').textContent = order.quantity;
            document.getElementById('modalUnitPrice').textContent = '$' + parseFloat(order.unit_price).toFixed(2);
            document.getElementById('modalWhatsAppInquiry').textContent = order.is_whatsapp_inquiry ? 'Yes' : 'No';
            document.getElementById('modalCustomerName').textContent = order.customer_name;
            document.getElementById('modalCustomerEmail').textContent = order.customer_email || 'N/A';
            document.getElementById('modalCustomerPhone').textContent = order.customer_phone || 'N/A';
            document.getElementById('modalWhatsAppNumber').textContent = order.whatsapp_number || 'N/A';
            document.getElementById('modalProductName').textContent = order.product_name || 'Product deleted';
            document.getElementById('modalProductSku').textContent = order.product_sku || 'N/A';
            document.getElementById('modalProductPrice').textContent = order.product_price ? '$' + parseFloat(order.product_price).toFixed(2) : 'N/A';
            document.getElementById('modalCustomerAddress').textContent = order.customer_address || 'N/A';
            document.getElementById('modalOrderNotes').textContent = order.notes || 'N/A';
            // document.getElementById('modalOrderCreated').textContent = order.created_at;
            // document.getElementById('modalOrderUpdated').textContent = order.updated_at;
            
            // Handle product image
            if (order.product_image) {
                document.getElementById('modalProductImage').src = '/images/products/' + order.product_image;
                document.getElementById('modalProductImage').style.display = 'block';
                document.getElementById('modalProductImagePlaceholder').style.display = 'none';
            } else {
                document.getElementById('modalProductImage').style.display = 'none';
                document.getElementById('modalProductImagePlaceholder').style.display = 'block';
            }
        })
        .catch(error => {
            console.error('Error fetching order details:', error);
            // Show error message
            document.getElementById('modalOrderId').textContent = 'Error loading order details';
        });
}

function getStatusBadge(status) {
    const statusClasses = {
        'pending': 'status-pending',
        'processing': 'status-processing', 
        'completed': 'status-completed',
        'cancelled': 'status-cancelled'
    };
    
    const className = statusClasses[status] || 'status-pending';
    return `<span class="status-badge ${className}">${status.charAt(0).toUpperCase() + status.slice(1)}</span>`;
}
 
function deleteOrder(orderId) { 
    Swal.fire({
        title: 'Delete Order?',
        text: "Are you sure you want to delete this order? This action cannot be undone.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#ef4444',
        cancelButtonColor: '#6b7280',
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            // Create form and submit
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = `/admin/orders/${orderId}`;
            
            // Add CSRF token
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            const csrfInput = document.createElement('input');
            csrfInput.type = 'hidden';
            csrfInput.name = '_token';
            csrfInput.value = csrfToken;
            form.appendChild(csrfInput);
            
            // Add DELETE method
            const methodInput = document.createElement('input');
            methodInput.type = 'hidden';
            methodInput.name = '_method';
            methodInput.value = 'DELETE';
            form.appendChild(methodInput);
            
            // Submit form
            document.body.appendChild(form);
            form.submit();
        }
    });
}
</script>
@endsection
