<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimeBlock extends Model
{
    use HasFactory;

	protected $fillable = [
		'name',
		'start_time',
		'stop_time',
		'description',
	];

	public function color()
	{
		return $this->belongsTo(Color::class, 'color_id');
	}
	public function calendarItems()
	{
		return $this->hasMany(CalendarItem::class);
	}
	public function availabilityItems()
	{
		return $this->hasMany(AvailabilityItem::class);
	}
}
