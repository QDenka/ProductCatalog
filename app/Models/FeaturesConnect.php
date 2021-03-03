<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class FeaturesConnect
 * 
 * @property int $feature_id
 * @property int $product_id
 * 
 * @property Feature $feature
 * @property Product $product
 *
 * @package App\Models
 */
class FeaturesConnect extends Model
{
	use HasFactory;

	protected $table = 'features_connect';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'feature_id' => 'int',
		'product_id' => 'int',
	];

	protected $fillable = [
		'feature_id',
		'product_id',
		'value'
	];

	public function feature()
	{
		return $this->belongsTo(Feature::class);
	}

	public function product()
	{
		return $this->belongsTo(Product::class);
	}
}
