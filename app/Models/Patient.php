<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Patient extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'name',
        'contact_no',
        'address',
        'email',
        'emergency_contact',
        'date_of_birth',
        'gender',
        'medical_history',
    ];

    protected $searchableFields = ['*'];

    protected $casts = [
        'date_of_birth' => 'date',
    ];

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    public function assessment()
    {
        return $this->hasOne(Assessment::class);
    }
}
