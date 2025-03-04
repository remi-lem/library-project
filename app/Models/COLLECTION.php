<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class COLLECTION
 * 
 * @property int $id
 * @property int $ISBN
 * 
 * @property Tome $tome
 * @property User $user
 *
 * @package App\Models
 */
class COLLECTION extends Model
{
	protected $table = 'COLLECTION';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'ISBN' => 'int'
	];

	public function tome()
	{
		return $this->belongsTo(Tome::class, 'ISBN');
	}

	public function user()
	{
		return $this->belongsTo(User::class, 'id');
	}
}
