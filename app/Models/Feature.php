<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Feature
 * 
 * @property int $id
 * @property string $name
 * @property string|null $type
 * 
 * @property FeaturesConnect $features_connect
 *
 * @package App\Models
 */
class Feature extends Model
{
	use HasFactory;

	protected $table = 'features';
	public $timestamps = false;

	protected $fillable = [
		'name',
		'type'
	];

	public function features_connect()
	{
		return $this->hasOne(FeaturesConnect::class);
	}
}
