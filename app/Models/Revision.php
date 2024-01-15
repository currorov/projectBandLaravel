<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Revision
 * 
 * @property int $id
 * @property Carbon $revision_date
 * @property string $company
 * @property string $observations
 * @property float $price
 * @property string $receipt
 * @property int $instrument_id
 * 
 * @property Instrument $instrument
 *
 * @package App\Models
 */
class Revision extends Model
{
	protected $table = 'revisions';
	public $timestamps = false;

	protected $casts = [
		'revision_date' => 'datetime',
		'price' => 'float',
		'instrument_id' => 'int'
	];

	protected $fillable = [
		'revision_date',
		'company',
		'observations',
		'price',
		'receipt',
		'instrument_id'
	];

	public function instrument()
	{
		return $this->belongsTo(Instrument::class);
	}
}
