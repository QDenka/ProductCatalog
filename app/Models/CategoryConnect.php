<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


/**
 * Class CategoryConnect
 * 
 * @property int $category_id
 * @property int $product_id
 * @property int $priority
 * 
 * @property Category $category
 * @property Product $product
 *
 * @package App\Models
 */
class CategoryConnect extends Model
{
	use HasFactory;

	protected $table = 'category_connect';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'category_id' => 'int',
		'product_id' => 'int'
	];

	protected $fillable = [
		'category_id',
		'product_id'
	];

	public function category()
	{
		return $this->belongsTo(Category::class);
	}

	public function product()
	{
		return $this->belongsTo(Product::class);
	}
}
