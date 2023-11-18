<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Appointment extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'date_time',
        'status',
        'note',
        'patient_id',
        'user_id',
    ];

    protected $searchableFields = ['*'];

    protected $casts = [
        'date_time' => 'datetime',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
