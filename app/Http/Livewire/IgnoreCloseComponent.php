<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Http\Request;
use App\Models\ignoredQuestion;

class IgnoreCloseComponent extends Component
{
    public $userId;
    public $questionId;

    public function mount ($userId,$questionId) 
    {
        $this->userId = $userId;
        $this->questionId = $questionId;
    }

    public function ignoreQuestion(Request $request)
    {
        ignoredQuestion::firstOrCreate([
            'user_id' => $this->userId,
            'question_id' => $this->questionId,
        ]);

        $this->emit('questionIgnored');
    }
    
    public function render()
    {
        return view('livewire.ignore-close-component');
    }
}
