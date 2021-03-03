<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Category
 * 
 * @property int $id
 * @property string $name
 * @property int $sub_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Category $category
 * @property Collection|Category[] $categories
 * @property CategoryConnect $category_connect
 *
 * @package App\Models
 */
class Category extends Model
{
	use HasFactory;

	protected $table = 'categories';

	protected $casts = [
		'sub_id' => 'int'
	];

	protected $fillable = [
		'name',
		'sub_id'
	];

	public function parent()
	{
		return $this->belongsTo(Category::class, 'sub_id');
	}

	public function children()
	{
		return $this->hasMany(Category::class, 'sub_id');
	}

	public function childrenCategory()
	{
		return $this->children()->with('childrenCategory');
	}

	public function category_connect()
	{
		return $this->hasOne(CategoryConnect::class);
	}
}
