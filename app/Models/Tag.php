<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Tag
 *
 * @property int $id
 * @property string $nom
 *
 * @package App\Models
 */
class Tag extends Model
{
	protected $table = 'Tag';
	public $timestamps = false;

	protected $fillable = [
		'nom'
	];
}
