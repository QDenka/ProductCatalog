<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Purchase
 * 
 * @property int $cart_id
 * @property int $product_id
 * @property int $count
 * 
 * @property Product $product
 * @property Cart $cart
 *
 * @package App\Models
 */
class CartList extends Model
{
	protected $table = 'cart_list';
    protected $primaryKey = null;

    public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'cart_id' => 'int',
		'product_id' => 'int',
		'count' => 'int'
	];

	protected $fillable = [
		'cart_id',
		'product_id',
		'count'
	];

	public function cart()
	{
		return $this->belongsTo(Cart::class);
	}

	public function product()
	{
		return $this->belongsTo(Product::class);
	}
}
