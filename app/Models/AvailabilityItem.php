<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AvailabilityItem extends Model
{
	public function user()
	{
		return $this->belongsTo(User::class, 'user_id');
	}

	public function timeblock()
	{
		return $this->belongsTo(Timeblock::class, 'time_block_id');
	}
}
