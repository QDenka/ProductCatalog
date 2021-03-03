<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * Class User
 * 
 * @property int $id
 * @property string $email
 * @property Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|ContactInfo[] $contact_infos
 * @property Collection|Purchase[] $purchases
 *
 * @package App\Models
 */
class User extends Authenticatable
{
	use HasFactory, Notifiable, HasApiTokens;

	protected $table = 'users';

	protected $dates = [
		'email_verified_at'
	];

	protected $hidden = [
		'password',
		'remember_token'
	];

	protected $fillable = [
		'email',
		'email_verified_at',
		'password',
		'remember_token'
	];

	public function contact_info()
	{
		return $this->hasOne(ContactInfo::class);
	}

	public function purchases()
	{
		return $this->hasMany(Purchase::class);
	}
}
