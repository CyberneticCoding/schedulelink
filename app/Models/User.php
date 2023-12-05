<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'active_company_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

	public function calendarItems()
	{
		return $this->hasMany(CalendarItem::class);
	}
	public function availabilityItems()
	{
		return $this->hasMany(AvailabilityItem::class);
	}
	public function companies()
	{
		return $this->belongsToMany(Company::class, 'company_user');
	}
	public function ownedCompanies()
	{
		return $this->hasMany(Company::class, 'owner_id');
	}
	public function activeCompany()
	{
		return $this->belongsTo(Company::class, 'active_company_id');
	}
}
