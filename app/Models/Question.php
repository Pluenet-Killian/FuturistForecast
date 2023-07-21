<?php

namespace App\Models;

use App\Models\User;
use App\Models\Vote;
use App\Models\Response;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function ignoreByUsers()
    {
        return $this->belongsToMany(User::class, 'ignored_questions');
    }

    public function responses()
    {
        return $this->hasMany(Response::class);
    }

    public function votes()
    {
        return $this->hasMany(Vote::class);
    }

 
    public function getTotalVotesAttribute()
    {
        return Vote::where('question_id', $this->id)->sum('vote');
    }

}
