<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Assessment extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['patient_id'];

    protected $searchableFields = ['*'];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function questions()
    {
        return $this->belongsToMany(Question::class, 'assessment_question')
        ->withPivot('answer_text')
        ->withTimestamps();
    }
}
