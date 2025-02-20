<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * Class Tome
 *
 * @property int $ISBN
 * @property int $numero
 * @property string $couverture
 * @property Carbon $dateParution
 * @property int $idEdition
 * @property int $idTypeLivre
 * @property int $idTagLivre
 * @property int $idGenreLivre
 * @property int $idAuteur
 * @property int $idEditeur
 *
 * @package App\Models
 */
class Tome extends Model
{
	protected $table = 'Tome';
	protected $primaryKey = 'ISBN';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'ISBN' => 'int',
		'numero' => 'int',
		'dateParution' => 'datetime',
		'idEdition' => 'int',
		'idTypeLivre' => 'int',
		'idTagLivre' => 'int',
		'idGenreLivre' => 'int',
		'idAuteur' => 'int',
		'idEditeur' => 'int'
	];

	protected $fillable = [
		'numero',
		'couverture',
		'dateParution',
		'idEdition',
		'idTypeLivre',
		'idTagLivre',
		'idGenreLivre',
		'idAuteur',
		'idEditeur'
	];

    public function auteur(): HasOne {
        return $this->hasOne(Auteur::class);
    }

}
