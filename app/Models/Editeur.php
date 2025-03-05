<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Editeur
 * 
 * @property int $id
 * @property string $nom
 * @property string|null $imgPattern
 *
 * @package App\Models
 */
class Editeur extends Model
{
	protected $table = 'Editeur';
	public $timestamps = false;

	protected $fillable = [
		'nom',
		'imgPattern'
	];
}
