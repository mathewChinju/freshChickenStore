@extends('layouts.admin')

@section('title', 'Edit Category - Admin')
@section('page-title', '')

@section('content')
<div class="container-standard">
    <div class="card-standard">
        <div class="card-header-standard">
            <div class="header-left">
                <h4 class="card-title-standard">
                    <i class="fas fa-edit me-2"></i>Edit Category
                </h4>
                <p class="card-subtitle-standard">Update category information: {{ $category->name }}</p>
            </div>
            <div class="header-right">
                <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-1"></i>Back to Categories
                </a>
            </div>
        </div>
        <div class="card-body-standard">
            <form action="{{ route('admin.categories.update', $category) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="form-grid">
                    <!-- Category Name -->
                    <div class="form-group-full">
                        <label for="name" class="form-label-standard">
                            Category Name <span class="required">*</span>
                        </label>
                        <input type="text" 
                               class="form-control-standard @error('name') is-invalid @enderror" 
                               id="name" 
                               name="name" 
                               value="{{ old('name', $category->name) }}" 
                               placeholder="Enter category name"
                               required>
                        @error('name')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Slug -->
                    <div class="form-group-full">
                        <label for="slug" class="form-label-standard">
                            Slug (URL-friendly name)
                        </label>
                        <input type="text" 
                               class="form-control-standard" 
                               id="slug" 
                               name="slug" 
                               value="{{ old('slug', $category->slug) }}" 
                               placeholder="auto-generated-from-name"
                               readonly>
                        <small class="text-muted">This will be automatically generated from the category name</small>
                    </div>

                    <!-- Description -->
                    <div class="form-group-full">
                        <label for="description" class="form-label-standard">
                            Description
                        </label>
                        <textarea class="form-control-standard @error('description') is-invalid @enderror" 
                                  id="description" 
                                  name="description" 
                                  rows="3" 
                                  placeholder="Enter category description (optional)">{{ old('description', $category->description) }}</textarea>
                        @error('description')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Parent Category and Sort Order -->
                    <div class="form-row">
                        <div class="form-group-half">
                            <label for="parent_id" class="form-label-standard">
                                Parent Category
                            </label>
                            <select class="form-control-standard @error('parent_id') is-invalid @enderror" 
                                    id="parent_id" 
                                    name="parent_id">
                                <option value="">None (Root Category)</option>
                                @foreach(\App\Models\Category::where('is_active', true)->where('id', '!=', $category->id)->orderBy('name')->get() as $cat)
                                    <option value="{{ $cat->id }}" 
                                            {{ (old('parent_id', $category->parent_id) == $cat->id) ? 'selected' : '' }}>
                                        {{ $cat->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('parent_id')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group-half">
                            <label for="sort_order" class="form-label-standard">
                                Sort Order
                            </label>
                            <input type="number" 
                                   class="form-control-standard @error('sort_order') is-invalid @enderror" 
                                   id="sort_order" 
                                   name="sort_order" 
                                   value="{{ old('sort_order', $category->sort_order) }}" 
                                   placeholder="0" 
                                   min="0">
                            @error('sort_order')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Image and Status -->
                    <div class="form-row">
                        <div class="form-group-half">
                            <label for="image" class="form-label-standard">
                                Category Image
                            </label>
                            <input type="file" 
                                   class="form-control-standard @error('image') is-invalid @enderror" 
                                   id="image" 
                                   name="image" 
                                   accept="image/*">
                            @error('image')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                            @if($category->image)
                                <div class="current-image-info">
                                    <small class="text-muted">Current image: {{ $category->image }}</small>
                                    <br>
                                    <img src="{{ asset('images/categories/' . $category->image) }}" 
                                         alt="{{ $category->name }}" 
                                         class="img-thumbnail mt-2" 
                                         style="max-width: 100px; max-height: 100px;">
                                </div>
                            @endif
                        </div>
                        <div class="form-group-half">
                            <label class="form-label-standard">
                                Category Status
                            </label>
                            <div class="form-check-standard">
                                <input class="form-check-input-standard @error('is_active') is-invalid @enderror" 
                                       type="checkbox" 
                                       id="is_active" 
                                       name="is_active" 
                                       value="1" 
                                       {{ old('is_active', $category->is_active) ? 'checked' : '' }}>
                                <label class="form-check-label-standard" for="is_active">
                                    Active
                                </label>
                            </div>
                            @error('is_active')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-2"></i>Update Category
                    </button>
                    <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times me-2"></i>Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

