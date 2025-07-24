<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Design extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'designer_id',
        'title',
        'description',
        'price',
        'image_path',
        'category',
        'tags',
        'is_featured',
        'is_active',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'price' => 'decimal:2',
        'tags' => 'array',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the designer that owns the design.
     */
    public function designer()
    {
        return $this->belongsTo(Designer::class);
    }

    /**
     * Get the full URL for the design image.
     *
     * @return string
     */
    public function getImageUrlAttribute()
    {
        return $this->image_path ? asset('designs/' . $this->image_path) : null;
    }

    /**
     * Scope a query to only include active designs.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope a query to only include featured designs.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    /**
     * Scope a query to filter by category.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  string  $category
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeByCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    /**
     * Scope a query to search designs by title or description.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  string  $search
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSearch($query, $search)
    {
        return $query->where(function ($q) use ($search) {
            $q->where('title', 'like', "%{$search}%")
              ->orWhere('description', 'like', "%{$search}%");
        });
    }

    /**
     * Get the orders for the design.
     */
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    /**
     * Get the total sales count for the design.
     *
     * @return int
     */
    public function getSalesCountAttribute()
    {
        return $this->orders()->where('status', '!=', Order::STATUS_CANCELLED)->sum('quantity');
    }

    /**
     * Get the total revenue for the design.
     *
     * @return float
     */
    public function getTotalRevenueAttribute()
    {
        return $this->orders()->where('status', '!=', Order::STATUS_CANCELLED)->sum('total_amount');
    }

    /**
     * Check if the design has been ordered.
     *
     * @return bool
     */
    public function hasOrders()
    {
        return $this->orders()->exists();
    }
}