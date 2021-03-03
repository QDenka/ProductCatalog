<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ContactInfo
 * 
 * @property int $id
 * @property int $user_id
 * @property string $firstname
 * @property string $lastname
 * @property string $middlename
 * @property string $phone
 * @property string $biling_address
 * 
 * @property User $user
 *
 * @package App\Models
 */
class ContactInfo extends Model
{
	protected $table = 'contact_info';
	public $timestamps = false;

	protected $casts = [
		'user_id' => 'int'
	];

	protected $fillable = [
		'user_id',
		'firstname',
		'lastname',
		'middlename',
		'phone',
		'biling_address'
	];

	public function purchase()
	{
		return $this->hasMany(Purchase::class);
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
