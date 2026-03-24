@extends('layouts.admin')

@section('title', 'Create Category - Admin')
@section('page-title', '')

@section('content')
<div class="container-standard">
    <div class="card-standard">
        <div class="card-header-standard">
            <div class="header-left">
                <h4 class="card-title-standard">
                    <i class="fas fa-plus me-2"></i>Create New Category
                </h4>
                <p class="card-subtitle-standard">Add a new category to organize your products</p>
            </div>
            <div class="header-right">
                <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-1"></i>Back to Categories
                </a>
            </div>
        </div>
        <div class="card-body-standard">
            <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
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
                               value="{{ old('name') }}" 
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
                               value="{{ old('slug') }}" 
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
                                  placeholder="Enter category description (optional)">{{ old('description') }}</textarea>
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
                                @foreach(\App\Models\Category::where('is_active', true)->where('id', '!=', old('parent_id'))->orderBy('name')->get() as $category)
                                    <option value="{{ $category->id }}" 
                                            {{ old('parent_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
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
                                   value="{{ old('sort_order', 0) }}" 
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
                                       {{ old('is_active', 1) ? 'checked' : '' }}>
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
                        <i class="fas fa-save me-2"></i>Create Category
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

