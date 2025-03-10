<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TagTome
 * 
 * @property float $ISBN
 * @property int $idTag
 *
 * @package App\Models
 */
class TagTome extends Model
{
	protected $table = 'TagTome';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'ISBN' => 'float',
		'idTag' => 'int'
	];

	protected $fillable = [
		'ISBN',
		'idTag'
	];
}
