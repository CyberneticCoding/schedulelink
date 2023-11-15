<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AvailabilityItem extends Model
{
	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function timeblock()
	{
		return $this->belongsTo(TimeBlock::class);
	}
}
