<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TypeLivre
 * 
 * @property int $id
 * @property string $nom
 *
 * @package App\Models
 */
class TypeLivre extends Model
{
	protected $table = 'TypeLivre';
	public $timestamps = false;

	protected $fillable = [
		'nom'
	];
}
