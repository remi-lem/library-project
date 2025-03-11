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
 * @property string|null $couverture
 * @property Carbon $dateParution
 * @property int|null $idEdition
 * @property int $idTypeLivre
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
        'titre' => 'string',
        'couverture' => 'string',
		'dateParution' => 'datetime',
		'idEdition' => 'int',
		'idTypeLivre' => 'int',
		'idGenreLivre' => 'int',
		'idAuteur' => 'int',
		'idEditeur' => 'int'
	];

	protected $fillable = [
        'ISBN',
		'numero',
        'titre',
		'couverture',
		'dateParution',
		'idEdition',
		'idTypeLivre',
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

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'TagTome', 'ISBN', 'idTag');
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

    public function users(){
        return $this->belongsToMany(User::class, 'Collection', 'ISBN', 'id');
    }
}
