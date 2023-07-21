<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Http\Requests\QuestionRequest;
use App\Http\Requests\ResponseRequest;
use App\Models\ignoredQuestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Question;
use App\Models\Response;
use App\Models\Vote;

class PostController extends Controller
{
    public function store(Request $request)
    {
        $action = $request->input('action');
        if ($action === 'question') {
            $validated = $request->validate([
                'title' => ['required', 'min:4']
            ]);
            $this->storeQuestion($validated);

        } elseif ($action === 'response') {
            $validated = $request->validate([
                'content' => ['required'],
                'question_id' => ['required']
            ]);
            $this->storeResponse($validated);
        } elseif ($action === 'ignore') {
            $this->ignoreQuestion($request);
        }

        elseif ($action === 'vote') {
            $this->vote($request);
        }

        return redirect()->route('home.index');
    }

    private function storeQuestion(array $validated)
    {
        $question = new Question([
            'title' => $validated['title'],
            'user_id' => Auth::id(),
        ]);
        $question->save();
    }

    public function storeResponse(array $validated)
    {
        $response = new Response([
            'content' => $validated['content'],
            'question_id' =>  $validated['question_id'], // récupérer l'ID de la question du formulaire
            'user_id' => Auth::id(),
        ]);
        $response->save();
    
        // Rediriger vers la question à laquelle la réponse a été donnée
        return redirect()->route('home.index');
    }

    public function ignoreQuestion(Request $request)
    {

        $ignoreQuestions = new ignoredQuestion([
            'user_id' => $request->user_id,
            'question_id' => $request->question_id,
        ]);

        $ignoreQuestions->save();

        return redirect()->route('home.index');
    }

    public function vote(Request $request)
    {
        // Find an existing vote
        $vote = Vote::where('user_id', $request->user_id)
            ->where('question_id', $request->question_id)
            ->first();
    
        $voteValue = $request->input('voteValue'); // this will be 1 for upvote and -1 for downvote
    
        // If a vote already exists
        if($vote) {
            // If the user had already voted the same way, remove the vote
            if ($vote->vote == $voteValue) {
                $vote->vote = 0;
            } 
            // Otherwise, record the new vote
            else {
                $vote->vote = $voteValue;
            }
        } 
        // If no vote exists, create a new vote
        else {
            $vote = new Vote([
                'user_id' => $request->user_id,
                'question_id' => $request->question_id,
                'vote' => $voteValue ,
            ]);
        }
        $vote->save();
    
        return redirect()->route('home.index');
    }
    
    


}
