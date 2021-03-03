<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Cart
 * 
 * @property int $id
 * @property string $identifier
 * @property string $content
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class Cart extends Model
{
	protected $table = 'cart';

	protected $fillable = [
		'identifier',
		'content'
	];
	

	public function cart_list()
	{
		return $this->hasMany(CartList::class)->with('product');
	}

	public function purchase()
	{
		return $this->hasOne(CartList::class);
	}
}
