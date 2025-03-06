<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Auteur
 * 
 * @property int $id
 * @property string $nom
 * @property string $prenom
 * @property string|null $nomComplet
 *
 * @package App\Models
 */
class Auteur extends Model
{
	protected $table = 'Auteur';
	public $timestamps = false;

	protected $fillable = [
		'nom',
		'prenom',
		'nomComplet'
	];
}
