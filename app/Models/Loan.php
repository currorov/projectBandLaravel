<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Loan
 * 
 * @property int $id
 * @property Carbon $start_date
 * @property Carbon|null $end_date
 * @property string|null $observations
 * @property string $musician_name
 * @property int $instrument_id
 * 
 * @property Instrument $instrument
 *
 * @package App\Models
 */
class Loan extends Model
{
	protected $table = 'loans';
	public $timestamps = false;

	protected $casts = [
		'start_date' => 'datetime',
		'end_date' => 'datetime',
		'instrument_id' => 'int'
	];

	protected $fillable = [
		'start_date',
		'end_date',
		'observations',
		'musician_name',
		'instrument_id'
	];

	public function instrument()
	{
		return $this->belongsTo(Instrument::class);
	}
}
