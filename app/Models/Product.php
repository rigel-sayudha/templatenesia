<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category_id',
        'description',
        'price',
        'discount_price',
        'image',
        'is_active',
        'is_popular',
        'benefits',
        'faqs',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_popular' => 'boolean',
        'benefits' => 'array',
        'faqs' => 'array',
    ];

    /**
     * Get the category for this product
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get reviews for this product
     */
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    /**
     * Get average rating
     */
    public function getAverageRatingAttribute()
    {
        return round($this->reviews()->where('is_visible', true)->avg('rating') ?? 5, 1);
    }

    /**
     * Get reviews count
     */
    public function getReviewsCountAttribute()
    {
        return $this->reviews()->where('is_visible', true)->count();
    }
}
