<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Edition
 *
 * @property int $id
 * @property string $nom
 * @property int $idSerie
 *
 * @package App\Models
 */
class Edition extends Model
{
	protected $table = 'Edition';
	public $timestamps = false;

	protected $casts = [
		'idSerie' => 'int'
	];

	protected $fillable = [
		'nom',
		'idSerie'
	];

    public function serie() {
        return $this->belongsTo(Serie::class, 'idSerie');
    }
}
