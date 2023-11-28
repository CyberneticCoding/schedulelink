<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

	public function users()
	{
		return $this->belongsToMany(User::class, 'company_user');
	}

	public function owner()
	{
		return $this->belongsTo(User::class, 'owner_id');
	}
}
