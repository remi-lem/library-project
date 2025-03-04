<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

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
        'ISBN',
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

    // Relations

    public function edition()
    {
        return $this->belongsTo(Edition::class, 'idEdition');
    }

    public function typeLivre()
    {
        return $this->belongsTo(TypeLivre::class, 'idTypeLivre');
    }

    public function tagLivre()
    {
        return $this->belongsTo(TagLivre::class, 'idTagLivre');
    }

    public function genreLivre()
    {
        return $this->belongsTo(GenreLivre::class, 'idGenreLivre');
    }

    public function auteur()
    {
        return $this->belongsTo(Auteur::class, 'idAuteur');
    }

    public function editeur()
    {
        return $this->belongsTo(Editeur::class, 'idEditeur');
    }
}
