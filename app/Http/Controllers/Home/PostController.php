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
        // Trouver un vote existant
        $vote = Vote::where('user_id', $request->user_id)
            ->where('question_id', $request->question_id)
            ->first();
    
        // Si un vote existe déjà
        if($vote) {
            if ($request->has('upVote')) {
                // Si l'utilisateur avait déjà upvoté, retirer le vote
                if ($vote->vote == 1) {
                    $vote->vote = 0;
                } 
                // Sinon, upvoter
                else {
                    $vote->vote = 1;
                }
            } elseif ($request->has('downVote')) {
                // Si l'utilisateur avait déjà downvoté, retirer le vote
                if ($vote->vote == -1) {
                    $vote->vote = 0;
                } 
                // Sinon, downvoter
                else {
                    $vote->vote = -1;
                }
            }
        } 
        // Si aucun vote n'existe, créer un nouveau vote
        else {
            $vote = new Vote([
                'user_id' => $request->user_id,
                'question_id' => $request->question_id,
                'vote' => $request->has('upVote') ? 1 : -1,
            ]);
        }
    
        $vote->save();
    
        return redirect()->route('home.index');
    }
    


}
