@extends('layouts.admin')

@section('title', 'Edit Product - Admin')
@section('page-title', '')

@section('content')
<div class="container-standard">
    <div class="card-standard">
        <div class="card-header-standard">
            <div class="header-left">
                <h4 class="card-title-standard">
                    <i class="fas fa-edit me-2"></i>Edit Product
                </h4>
                <p class="card-subtitle-standard">Update product information: {{ $product->name }}</p>
            </div>
            <div class="header-right">
                <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-1"></i>Back to Products
                </a>
            </div>
        </div>
        <div class="card-body-standard">
            <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="form-grid">
                    <!-- Product Name -->
                    

                     <div class="form-row">
                         <div class="form-group-half">
                           <label for="name" class="form-label-standard">
                            Product Name <span class="required">*</span>
                            </label>
                            <input type="text" 
                                class="form-control-standard @error('name') is-invalid @enderror" 
                                id="name" 
                                name="name" 
                                value="{{ old('name', $product->name) }}" 
                                placeholder="Enter product name"
                                required>
                            @error('name')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group-half">
                            <label for="sku" class="form-label-standard">
                                SKU <span class="required">*</span>
                            </label>
                            <input type="text" 
                                   class="form-control-standard @error('sku') is-invalid @enderror" 
                                   id="sku" 
                                   name="sku" 
                                   value="{{ old('sku', $product->sku) }}" 
                                   placeholder="Unique product identifier"
                                   required>
                            @error('sku')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                       
                    </div>



                    <!-- Description -->
                    <div class="form-group-full">
                        <label for="description" class="form-label-standard">
                            Description <span class="required">*</span>
                        </label>
                        <textarea class="form-control-standard @error('description') is-invalid @enderror" 
                                  id="description" 
                                  name="description" 
                                  rows="3" 
                                  placeholder="Enter product description"
                                  required>{{ old('description', $product->description) }}</textarea>
                        @error('description')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Tags -->
                    <div class="form-group-full">
                        <label for="tags" class="form-label-standard">
                            Product Tags
                        </label>
                        <input type="text" 
                               class="form-control-standard @error('tags') is-invalid @enderror" 
                               id="tags" 
                               name="tags" 
                               value="{{ old('tags', $product->tags) }}" 
                               placeholder="Enter tags separated by commas (e.g., fresh, organic, premium)">
                        <div class="form-help-text">
                            Separate multiple tags with commas. Tags will be displayed on the product page.
                        </div>
                        @error('tags')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- SKU and Category -->
                    <div class="form-row">
                       <div class="form-group-half">
                            <label for="price" class="form-label-standard">
                                Price <span class="required">*</span>
                            </label>
                            <input type="number" 
                                   class="form-control-standard @error('price') is-invalid @enderror" 
                                   id="price" 
                                   name="price" 
                                   value="{{ old('price', $product->price) }}" 
                                   placeholder="0.00" 
                                   step="0.01" 
                                   min="0" 
                                   required>
                            @error('price')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group-half">
                            <label for="category_id" class="form-label-standard">
                                Category
                            </label>
                            <select class="form-control-standard @error('category_id') is-invalid @enderror" 
                                    id="category_id" 
                                    name="category_id">
                                <option value="">Select Category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" 
                                            {{ (old('category_id', $product->category_id) == $category->id) ? 'selected' : '' }}>
                                        {{ $category->parent ? $category->parent->name . ' > ' : '' }}{{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    

                    <!-- Weight and Sort Order -->
                    <div class="form-row">
                        <div class="form-group-half">
                            <label class="form-label-standard">
                                Weight Type & Values
                            </label>
                            @php
                                $standardValues = "500g,1kg,2kg";
                                $initialWeight = old('weight', $product->weight);
                                $isStandard = ($initialWeight === $standardValues);
                                $initialType = old('weight_type', $isStandard ? 'standard' : 'custom');
                            @endphp
                            <div class="weight-input-container" style="display: flex; gap: 10px; align-items: flex-start;">
                                <div style="flex: 1;">
                                    <select id="weight_type" class="form-control-standard">
                                        <option value="standard" {{ $initialType == 'standard' ? 'selected' : '' }}>Weight</option>
                                        <option value="custom" {{ $initialType == 'custom' ? 'selected' : '' }}>Custom weight</option>
                                    </select>
                                </div>

                                <div id="standard_weight_container" style="flex: 2; display: {{ $initialType == 'standard' ? 'block' : 'none' }};">
                                    <input type="text" id="weight_standard" class="form-control-standard" 
                                           value="500g,1kg,2kg" readonly style="background-color: #f8f9fa; cursor: not-allowed;">
                                </div>

                                <div id="custom_weight_container" style="flex: 2; display: {{ $initialType == 'custom' ? 'block' : 'none' }};">
                                    <input type="text" id="weight_custom" class="form-control-standard" 
                                           value="{{ $initialType == 'custom' ? $initialWeight : '' }}" 
                                           placeholder="Enter values (e.g. 1100g, 1200g)">
                                </div>

                                <input type="hidden" name="weight" id="weight_final" value="{{ $initialWeight }}">
                            </div>
                            @error('weight')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                const weightType = document.getElementById('weight_type');
                                const standardContainer = document.getElementById('standard_weight_container');
                                const customContainer = document.getElementById('custom_weight_container');
                                const weightStandard = document.getElementById('weight_standard');
                                const weightCustom = document.getElementById('weight_custom');
                                const weightFinal = document.getElementById('weight_final');

                                function updateFinalWeight() {
                                    if (weightType.value === 'standard') {
                                        weightFinal.value = weightStandard.value;
                                        standardContainer.style.display = 'block';
                                        customContainer.style.display = 'none';
                                    } else {
                                        weightFinal.value = weightCustom.value;
                                        standardContainer.style.display = 'none';
                                        customContainer.style.display = 'block';
                                        weightCustom.focus();
                                    }
                                }

                                weightType.addEventListener('change', updateFinalWeight);
                                weightCustom.addEventListener('input', function() {
                                    if (weightType.value === 'custom') {
                                        weightFinal.value = this.value;
                                    }
                                });

                                // Initial sync
                                if (weightType.value === 'standard') {
                                    weightFinal.value = weightStandard.value;
                                } else {
                                    weightFinal.value = weightCustom.value;
                                }
                            });
                        </script>
                        <div class="form-group-half">
                            <label for="rating" class="form-label-standard">
                                Rating
                            </label>
                            <input type="number" 
                                   class="form-control-standard @error('rating') is-invalid @enderror" 
                                   id="rating" 
                                   name="rating" 
                                   value="{{ old('rating', $product->rating) }}" 
                                   placeholder="4.5" 
                                   step="0.1"
                                   min="0"
                                   max="5">
                            @error('rating')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-row-standard">
                        <div class="form-group-half">
                            <label for="sort_order" class="form-label-standard">
                                Sort Order
                            </label>
                            <input type="number" 
                                   class="form-control-standard @error('sort_order') is-invalid @enderror" 
                                   id="sort_order" 
                                   name="sort_order" 
                                   value="{{ old('sort_order', $product->sort_order) }}" 
                                   placeholder="0" 
                                   min="0">
                            @error('sort_order')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group-half d-flex align-items-center" style="padding-top: 2rem;">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="is_out_of_stock" name="is_out_of_stock" value="1" {{ old('is_out_of_stock', $product->is_out_of_stock) ? 'checked' : '' }}>
                                <label class="form-check-label ms-2" for="is_out_of_stock">Mark as Out of Stock</label>
                            </div>
                        </div>
                    </div>

                    <!-- Product Images -->
                    <div class="form-group-full">
                        <label class="form-label-standard">
                            Product Images <small class="text-muted">(Maximum 5 images, each up to 2MB)</small>
                        </label>
                        
                        <!-- Existing Images -->
                        @if($product->images->count() > 0)
                            <div class="existing-images-container mb-3">
                                <h6 class="text-muted mb-2">Current Images</h6>
                                <div class="image-preview-container">
                                    @foreach($product->images as $productImage)
                                        <div class="image-preview-item existing-image" data-image-id="{{ $productImage->id }}">
                                            <div class="image-preview-wrapper">
                                                <img src="{{ $productImage->image_url }}" alt="{{ $product->name }}" class="preview-image">
                                                <div class="image-preview-overlay">
                                                    @if($productImage->is_primary)
                                                        <span class="badge bg-primary">Primary</span>
                                                    @else
                                                        <button type="button" class="btn btn-sm btn-outline-light set-primary" data-image-id="{{ $productImage->id }}" title="Set as primary">
                                                            <i class="fas fa-star"></i>
                                                        </button>
                                                    @endif
                                                    <button type="button" class="btn btn-sm btn-danger remove-existing-image" data-image-id="{{ $productImage->id }}" title="Remove image">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="image-preview-info">
                                                <small class="text-muted">{{ $productImage->image_path }}</small>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                        
                        <!-- New Image Upload Area -->
                        <div class="product-images-upload">
                            <div class="file-upload-area" id="imageUploadArea">
                                <div class="upload-placeholder">
                                    <i class="fas fa-cloud-upload-alt fa-3x text-muted mb-3"></i>
                                    <p class="text-muted">Click to upload or drag and drop</p>
                                    <p class="text-muted small">PNG, JPG, GIF up to 2MB each</p>
                                </div>
                                <input type="file" 
                                       id="productImages" 
                                       name="images[]" 
                                       class="file-input" 
                                       accept="image/*" 
                                       multiple
                                       style="display: none;">
                            </div>
                            <div id="imagePreviewContainer" class="image-preview-container mt-3">
                                <!-- Image previews will be added here -->
                            </div>
                        </div>
                        @error('images.*')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Legacy Single Image (for backward compatibility) -->
                    <div class="form-group-full">
                        <label for="image" class="form-label-standard">
                            Single Product Image <span class="required">*</span> <small class="text-muted">(Required - for backward compatibility)</small>
                        </label>
                        <input type="file" 
                               class="form-control-standard @error('image') is-invalid @enderror" 
                               id="image" 
                               name="image" 
                               accept="image/*"
                               required>
                        @error('image')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                        @if($product->image)
                            <div class="current-image-info">
                                <small class="text-muted">Current legacy image: {{ $product->image }}</small>
                                <br>
                                <img src="{{ $product->primary_image_url }}" 
                                     alt="{{ $product->name }}" 
                                     class="img-thumbnail mt-2" 
                                     style="max-width: 100px; max-height: 100px;">
                            </div>
                        @endif
                    </div>

                    <!-- Product Status -->
                    <div class="form-group-full">
                        <label class="form-label-standard">
                            Product Status
                        </label>
                        <div class="form-check-standard">
                            <input class="form-check-input-standard @error('is_active') is-invalid @enderror" 
                                   type="checkbox" 
                                   id="is_active" 
                                   name="is_active" 
                                   value="1" 
                                   {{ old('is_active', $product->is_active) ? 'checked' : '' }}>
                            <label class="form-check-label-standard" for="is_active">
                                Active
                            </label>
                        </div>
                        @error('is_active')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-2"></i>Update Product
                    </button>
                    <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times me-2"></i>Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const imageUploadArea = document.getElementById('imageUploadArea');
    const productImagesInput = document.getElementById('productImages');
    const imagePreviewContainer = document.getElementById('imagePreviewContainer');
    const productId = {{ $product->id }};
    let uploadedFiles = [];

    // Click to upload
    if (imageUploadArea) {
        imageUploadArea.addEventListener('click', function() {
            productImagesInput.click();
        });

        // Drag and drop functionality
        imageUploadArea.addEventListener('dragover', function(e) {
            e.preventDefault();
            this.classList.add('drag-over');
        });

        imageUploadArea.addEventListener('dragleave', function(e) {
            e.preventDefault();
            this.classList.remove('drag-over');
        });

        imageUploadArea.addEventListener('drop', function(e) {
            e.preventDefault();
            this.classList.remove('drag-over');
            
            const files = Array.from(e.dataTransfer.files).filter(file => file.type.startsWith('image/'));
            handleFiles(files);
        });
    }

    // File input change
    if (productImagesInput) {
        productImagesInput.addEventListener('change', function(e) {
            const files = Array.from(e.target.files);
            handleFiles(files);
        });
    }

    // Handle existing image removal
    document.querySelectorAll('.remove-existing-image').forEach(button => {
        button.addEventListener('click', function() {
            const imageId = this.dataset.imageId;
            
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    removeExistingImage(imageId);
                }
            });
        });
    });

    // Handle setting primary image
    document.querySelectorAll('.set-primary').forEach(button => {
        button.addEventListener('click', function() {
            const imageId = this.dataset.imageId;
            setPrimaryImage(imageId);
        });
    });

    function handleFiles(files) {
        // Check total images (existing + new) don't exceed 5
        const existingCount = document.querySelectorAll('.existing-image').length;
        if (existingCount + uploadedFiles.length + files.length > 5) {
            Swal.fire({
                icon: 'warning',
                title: 'Image Limit Exceeded',
                text: 'You can only have a maximum of 5 images per product.',
                confirmButtonColor: '#3085d6'
            });
            return;
        }

        files.forEach((file, index) => {
            // Check file size (2MB limit)
            if (file.size > 2 * 1024 * 1024) {
                Swal.fire({
                    icon: 'error',
                    title: 'File Too Large',
                    text: `File ${file.name} is too large. Maximum size is 2MB.`,
                    confirmButtonColor: '#3085d6'
                });
                return;
            }

            const reader = new FileReader();
            reader.onload = function(e) {
                const imageId = 'image_' + Date.now() + '_' + index;
                uploadedFiles.push({ id: imageId, file: file, url: e.target.result });
                
                const preview = createImagePreview(imageId, e.target.result, file.name);
                imagePreviewContainer.appendChild(preview);
            };
            reader.readAsDataURL(file);
        });
    }

    function createImagePreview(id, url, fileName) {
        const previewDiv = document.createElement('div');
        previewDiv.className = 'image-preview-item';
        previewDiv.id = id;
        
        previewDiv.innerHTML = `
            <div class="image-preview-wrapper">
                <img src="${url}" alt="${fileName}" class="preview-image">
                <div class="image-preview-overlay">
                    <button type="button" class="btn btn-sm btn-danger remove-image" data-id="${id}">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="image-preview-info">
                <small class="text-muted">${fileName}</small>
            </div>
        `;

        // Add remove functionality
        previewDiv.querySelector('.remove-image').addEventListener('click', function() {
            removeImage(id);
        });

        return previewDiv;
    }

    function removeImage(id) {
        const previewDiv = document.getElementById(id);
        if (previewDiv) {
            previewDiv.remove();
        }
        
        // Remove from uploaded files array
        uploadedFiles = uploadedFiles.filter(item => item.id !== id);
        
        // Update file input
        updateFileInput();
    }

    function updateFileInput() {
        // Create a new FileList with the remaining files
        const dt = new DataTransfer();
        uploadedFiles.forEach(item => {
            dt.items.add(item.file);
        });
        if (productImagesInput) {
            productImagesInput.files = dt.files;
        }
    }

    function removeExistingImage(imageId) {
        fetch(`/admin/products/${productId}/images/${imageId}/remove`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const imageElement = document.querySelector(`[data-image-id="${imageId}"]`);
                if (imageElement) {
                    imageElement.remove();
                }
                
                // Handle automatic primary image assignment
                if (data.new_primary) {
                    // Remove all primary badges and buttons
                    document.querySelectorAll('.image-preview-overlay .badge').forEach(badge => {
                        badge.remove();
                    });
                    document.querySelectorAll('.set-primary').forEach(button => {
                        button.style.display = 'none';
                    });
                    
                    // Add primary badge to the new primary image
                    const newPrimaryElement = document.querySelector(`[data-image-id="${data.new_primary.id}"] .image-preview-overlay`);
                    if (newPrimaryElement) {
                        const badge = document.createElement('span');
                        badge.className = 'badge bg-primary';
                        badge.textContent = 'Primary';
                        newPrimaryElement.appendChild(badge);
                    }
                }
                
                // Show success message
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: data.message,
                    timer: 3000,
                    showConfirmButton: false
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: data.message || 'Failed to remove image',
                    confirmButtonColor: '#3085d6'
                });
            }
        })
        .catch(error => {
            console.error('Error:', error);
           // alert('An error occurred while removing the image');
        });
    }

    function setPrimaryImage(imageId) {
        fetch(`/admin/products/${productId}/images/${imageId}/set-primary`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Remove all primary badges
                document.querySelectorAll('.image-preview-overlay .badge').forEach(badge => {
                    badge.remove();
                });
                
                // Remove all set-primary buttons
                document.querySelectorAll('.set-primary').forEach(button => {
                    button.style.display = 'none';
                });
                
                // Add primary badge to selected image
                const imageElement = document.querySelector(`[data-image-id="${imageId}"] .image-preview-overlay`);
                if (imageElement) {
                    const badge = document.createElement('span');
                    badge.className = 'badge bg-primary';
                    badge.textContent = 'Primary';
                    imageElement.appendChild(badge);
                }
                
                // Show success message
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: data.message,
                    timer: 3000,
                    showConfirmButton: false
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: data.message || 'Failed to set primary image',
                    confirmButtonColor: '#3085d6'
                });
            }
        })
        .catch(error => {
            console.error('Error:', error);
           // alert('An error occurred while setting the primary image');
        });
    }

    // Add some basic styles
    const style = document.createElement('style');
    style.textContent = `
        .file-upload-area {
            border: 2px dashed #ddd;
            border-radius: 8px;
            padding: 40px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .file-upload-area:hover,
        .file-upload-area.drag-over {
            border-color: #007bff;
            background-color: #f8f9fa;
        }
        
        .image-preview-container {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
        }
        
        .image-preview-item {
            position: relative;
            width: 150px;
            border: 1px solid #ddd;
            border-radius: 8px;
            overflow: hidden;
        }
        
        .image-preview-wrapper {
            position: relative;
            width: 100%;
            height: 120px;
        }
        
        .preview-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .image-preview-overlay {
            position: absolute;
            top: 0;
            right: 0;
            padding: 5px;
            display: flex;
            gap: 5px;
        }
        
        .image-preview-info {
            padding: 8px;
            background-color: #f8f9fa;
        }
        
        .existing-images-container {
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 8px;
        }
        
        .upload-placeholder {
            color: #6c757d;
        }
    `;
    document.head.appendChild(style);
});
</script>
@endpush


