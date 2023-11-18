<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use App\Models\Scopes\Searchable;
use Spatie\Permission\Traits\HasRoles;
use Laravel\Jetstream\HasProfilePhoto;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasRoles;
    use Notifiable;
    use HasFactory;
    use Searchable;
    use HasApiTokens;
    use HasProfilePhoto;
    use TwoFactorAuthenticatable;

    protected $fillable = [
        'name',
        'contact_no',
        'address',
        'date_of_birth',
        'gender',
        'email',
        'password',
        'specialization',
        'schedule',
    ];

    protected $searchableFields = ['*'];

    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_secret',
        'two_factor_recovery_codes',
    ];

    protected $casts = [
        'date_of_birth' => 'date',
        'email_verified_at' => 'datetime',
        'schedule' => 'date',
        'two_factor_confirmed_at' => 'datetime',
    ];

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    public function isSuperAdmin()
    {
        return $this->hasRole('super-admin');
    }
}
