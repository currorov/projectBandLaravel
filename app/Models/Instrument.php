<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Instrument
 * 
 * @property int $id
 * @property string $family
 * @property string $type
 * @property string $brand
 * @property string $model
 * @property string|null $serial_number
 * @property Carbon|null $acquisition_date
 * @property string $state
 * @property string|null $comment
 * @property string|null $image
 * @property int $band_id
 * 
 * @property Collection|Loan[] $loans
 * @property Collection|Revision[] $revisions
 *
 * @package App\Models
 */
class Instrument extends Model
{
	protected $table = 'instruments';
	public $timestamps = false;

	protected $casts = [
		'acquisition_date' => 'datetime',
		'band_id' => 'int'
	];

	protected $fillable = [
		'family',
		'type',
		'brand',
		'model',
		'serial_number',
		'acquisition_date',
		'state',
		'comment',
		'image',
		'band_id'
	];

	public function loans()
	{
		return $this->hasMany(Loan::class);
	}

	public function revisions()
	{
		return $this->hasMany(Revision::class);
	}
}
