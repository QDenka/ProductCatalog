<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Purchase
 * 
 * @property int $id
 * @property int $user_id
 * @property float $purchase_amount
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property User $user
 * @property ContactInfo $contactInfo
 * @property Cart $cart
 *
 * @package App\Models
 */
class Purchase extends Model
{
	protected $table = 'purchases';

	protected $casts = [
		'user_id' => 'int',
		'contact_id' => 'int',
		'purchase_amount' => 'float'
	];

	protected $fillable = [
		'user_id',
		'contact_id',
		'purchase_amount'
	];

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function contact()
	{
		return $this->belongsTo(ContactInfo::class);
	}

	public function cart()
	{
		return $this->belongsTo(Cart::class)->with('cart_list.product');
	}
}
