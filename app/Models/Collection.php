<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Collection
 *
 * @property int $id
 * @property int $ISBN
 *
 * @property Tome $tome
 * @property User $user
 *
 * @package App\Models
 */
class Collection extends Model
{
	protected $table = 'Collection';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'ISBN' => 'int'
	];

    protected $fillable = [
        'id',
        'ISBN'
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
