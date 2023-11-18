<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Question extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['question_text'];

    protected $searchableFields = ['*'];

    public function assessments()
    {
        return $this->belongsToMany(Assessment::class)->withPivot('answer_text');
    }
}
