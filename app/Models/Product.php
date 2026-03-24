<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'image',
        'stock_quantity',
        'is_active',
        'sku',
        'weight',
        'category_id',
        'rating',
        'is_out_of_stock'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'is_active' => 'boolean',
        'is_out_of_stock' => 'boolean'
    ];

    protected $appends = [
        'primary_image_url',
        'category_name',
        'stock_status',
        'stock_status_badge',
        'total_sold'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class)->ordered();
    }

    public function primaryImage()
    {
        return $this->hasOne(ProductImage::class)->primary();
    }

    public function getCategoryNameAttribute()
    {
        return $this->category ? $this->category->name : 'Uncategorized';
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeByCategory($query, $categoryId)
    {
        return $query->where('category_id', $categoryId);
    }

    public function scopeSearch($query, $search)
    {
        return $query->where(function($q) use ($search) {
            $q->where('name', 'like', "%{$search}%")
              ->orWhere('description', 'like', "%{$search}%")
              ->orWhere('sku', 'like', "%{$search}%");
        });
    }

    public function scopeByPriceRange($query, $minPrice = null, $maxPrice = null)
    {
        if ($minPrice !== null) {
            $query->where('price', '>=', $minPrice);
        }
        if ($maxPrice !== null) {
            $query->where('price', '<=', $maxPrice);
        }
        return $query;
    }

    public function scopeByStock($query, $stockStatus = null)
    {
        switch ($stockStatus) {
            case 'in_stock':
                return $query->where('stock_quantity', '>', 0);
            case 'out_of_stock':
                return $query->where('stock_quantity', '=', 0);
            case 'low_stock':
                return $query->where('stock_quantity', '>', 0)->where('stock_quantity', '<=', 10);
            default:
                return $query;
        }
    }

    public function getStockStatusAttribute()
    {
        if ($this->is_out_of_stock) {
            return 'out_of_stock';
        } else {
            return 'in_stock';
        }
    }

    public function getStockStatusBadgeAttribute()
    {
        $status = $this->stock_status;
        $badges = [
            'in_stock' => '<span class="badge bg-success">In Stock (' . $this->stock_quantity . ')</span>',
            'low_stock' => '<span class="badge bg-warning">Low Stock (' . $this->stock_quantity . ')</span>',
            'out_of_stock' => '<span class="badge bg-danger">Out of Stock</span>'
        ];
        
        return $badges[$status] ?? '<span class="badge bg-secondary">Unknown</span>';
    }

    public function reduceStock($quantity)
    {
        if ($this->stock_quantity >= $quantity) {
            $this->decrement('stock_quantity', $quantity);
            return true;
        }
        return false;
    }

    public function addStock($quantity)
    {
        $this->increment('stock_quantity', $quantity);
        return true;
    }

    public function getTotalSoldAttribute()
    {
        return $this->orders()->sum('quantity');
    }

    public function getPrimaryImageUrlAttribute()
    {
        $primaryImage = $this->primaryImage;
        
        if ($primaryImage) {
            return $primaryImage->image_url;
        }
        
        // Fallback to first image if no primary is set
        $firstImage = $this->images()->orderBy('sort_order')->first();
        if ($firstImage) {
            return $firstImage->image_url;
        }
        
        // Fallback to legacy single image
        if ($this->image) {
            return asset('images/products/' . $this->image);
        }

        // Fallback to category image
        if ($this->category && $this->category->image) {
            return asset('images/categories/' . $this->category->image);
        }
        
        return null;
    }

    public function addImages($images, $makeFirstPrimary = true)
    {
        $addedImages = [];
        $sortOrder = $this->images()->max('sort_order') ?? 0;
        
        foreach ($images as $index => $image) {
            $imagePath = time() . '_' . $index . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/products'), $imagePath);
            
            $productImage = $this->images()->create([
                'image_path' => $imagePath,
                'sort_order' => $sortOrder + $index,
                'is_primary' => $makeFirstPrimary && $index === 0 && !$this->primaryImage
            ]);
            
            $addedImages[] = $productImage;
        }
        
        // Ensure there's always a primary image after adding
        if ($addedImages && !$this->primaryImage) {
            $this->ensurePrimaryImage();
        }
        
        return $addedImages;
    }

    public function removeImage($imageId)
    {
        $productImage = $this->images()->find($imageId);
        if ($productImage) {
            $wasPrimary = $productImage->is_primary;
            
            $imagePath = public_path('images/products/' . $productImage->image_path);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
            $productImage->delete();
            
            // If we deleted the primary image, assign a new one
            if ($wasPrimary) {
                $this->ensurePrimaryImage();
            }
            
            return true;
        }
        return false;
    }

    public function ensurePrimaryImage()
    {
        // Check if there's any primary image
        $primaryImage = $this->images()->where('is_primary', true)->first();
        
        // If no primary image exists and there are other images, set the first one as primary
        if (!$primaryImage && $this->images()->count() > 0) {
            $firstImage = $this->images()->orderBy('sort_order')->first();
            if ($firstImage) {
                $firstImage->update(['is_primary' => true]);
                return $firstImage;
            }
        }
        
        return $primaryImage;
    }

    public function setPrimaryImage($imageId)
    {
        // Remove primary status from all images
        $this->images()->update(['is_primary' => false]);
        
        // Set new primary image
        $productImage = $this->images()->find($imageId);
        if ($productImage) {
            $productImage->update(['is_primary' => true]);
            return true;
        }
        return false;
    }
}
