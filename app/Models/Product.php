<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Product
 * 
 * @property int $id
 * @property string $slug
 * @property float $price
 * @property string|null $description
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property CategoryConnect $category_connect
 * @property FeaturesConnect $features_connect
 * @property ItemsPurchase $items_purchase
 *
 * @package App\Models
 */
class Product extends Model
{
	use HasFactory;

	protected $table = 'products';

	protected $casts = [
		'price' => 'float'
	];

	protected $fillable = [
		'slug',
		'price',
		'name',
		'description'
	];

	public function category()
	{
		return $this->category_connect()->with('category.childrenCategory');
	}

	public function category_connect()
	{
		return $this->hasMany(CategoryConnect::class);
	}

	public function features()
	{
		return $this->hasMany(FeaturesConnect::class)->with('feature.features_connect');
	}

	public function feature_connect()
	{
		return $this->hasMany(FeaturesConnect::class);
	}

	public function cart_list()
	{
		return $this->hasMany(CartList::class);
	}

	public function items_purchase()
	{
		return $this->hasOne(ItemsPurchase::class);
	}
}
