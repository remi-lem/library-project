<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TagLivre
 * 
 * @property int $id
 * @property string $nom
 *
 * @package App\Models
 */
class TagLivre extends Model
{
	protected $table = 'TagLivre';
	public $timestamps = false;

	protected $fillable = [
		'nom'
	];
}
