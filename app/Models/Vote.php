<?php

namespace App\Models;

use App\Models\Question;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Vote extends Model
{
    use HasFactory;


    protected $fillable = [
        'user_id',
        'question_id',
        'upVote',
        'downVote',
    ];

    
    public function questions() 
    {
        return $this->belongsTo(Question::class);
    }
}
