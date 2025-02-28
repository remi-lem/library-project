<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class GenreLivre
 * 
 * @property int $id
 * @property string $nom
 *
 * @package App\Models
 */
class GenreLivre extends Model
{
	protected $table = 'GenreLivre';
	public $timestamps = false;

	protected $fillable = [
		'nom'
	];
}
