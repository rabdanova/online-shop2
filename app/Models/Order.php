<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property int $phone_number
 * @property string $address
 * @property string $comment
 */
class Order extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'phone_number',
        'address',
        'comment',
    ];

    public function orderProducts()
    {
        return $this->hasMany(OrderProduct::class, 'order_id', 'id');
    }

}
