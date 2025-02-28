<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Serie
 * 
 * @property int $id
 * @property string $nom
 * @property string $synopsis
 *
 * @package App\Models
 */
class Serie extends Model
{
	protected $table = 'Serie';
	public $timestamps = false;

	protected $fillable = [
		'nom',
		'synopsis'
	];
}
