<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
/**
 * @property int $id
 * @property string $name
 * @property string $description
 * @property float $price
 * @property string $image_url
 */

class Product extends Model
{
    protected $fillable = [
        'name',
        'description',
        'price',
        'image_url'
    ];

    public function reviews()
    {
        return $this->hasMany(Review::class, 'product_id', 'id');
    }
}
