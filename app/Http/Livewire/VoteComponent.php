<?php

namespace App\Http\Livewire;

use App\Models\Vote;
use Livewire\Component;
use App\Models\Question;
use Illuminate\Http\Request;
use App\Models\ignoredQuestion;
use Illuminate\Support\Facades\Auth;

class VoteComponent extends Component
{

    public $userId;
    public $questionId;
    public $voteValue;
    public $totalVotes;

    public function mount($userId, $questionId, $voteValue, $totalVotes)
    {
        $this->userId = $userId;
        $this->questionId = $questionId;
        $this->voteValue = $voteValue;
        $this->totalVotes = $totalVotes;
    }

    protected $listeners = ['voteUpdated' => 'updateVotes'];
    
    public function updateVotes()
    {
        $this->totalVotes = Vote::where('question_id', $this->questionId)->sum('vote');
    }

    public function vote()
    {
        $vote = Vote::where('user_id', $this->userId)
            ->where('question_id', $this->questionId)
            ->first();

        if ($vote) {
            if ($vote->vote == $this->voteValue) {
                $vote->vote = 0;
            } else {
                $vote->vote = $this->voteValue;
            }
        } else {
            $vote = new Vote([
                'user_id' => $this->userId,
                'question_id' => $this->questionId,
                'vote' => $this->voteValue ,
            ]);
        }

        $vote->save();
        $this->emit('voteUpdated');
    }

    public function render()
    {
        return view('livewire.vote-component');
    }
}
