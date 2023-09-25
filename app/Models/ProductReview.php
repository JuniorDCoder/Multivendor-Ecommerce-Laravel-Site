<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductReview extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function productReviewGalleries()
    {
        return $this->hasMany(ProductReviewGallery::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
