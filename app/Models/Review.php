<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $product_id
 * @property int $user_id
 * @property string $name
 * @property string $comment
 * @property int $rating
 */
class Review extends Model
{
    protected $fillable = [
        'product_id',
        'user_id',
        'name',
        'comment',
        'rating'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
