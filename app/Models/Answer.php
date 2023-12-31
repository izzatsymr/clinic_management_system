<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Answer extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['answer_text', 'question_id'];

    protected $searchableFields = ['*'];

    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
