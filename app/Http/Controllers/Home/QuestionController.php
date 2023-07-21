<?php

namespace App\Http\Controllers\Home;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Vote;
use App\Models\Question;
use App\Models\Response;
use Illuminate\Http\Request;
use App\Models\ignoredQuestion;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\QuestionRequest;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     */

     private function getQuestions() {
        $ignoredQuestionIds = ignoredQuestion::where('user_id', Auth::id())->pluck('question_id');
        return Question::whereNotIn('id', $ignoredQuestionIds)->orderBy('created_at', 'desc')->paginate(8);
    }

    public function index()
    {   
        $questions = $this->getQuestions();

        return view('home.home', [
            'questions' => $questions,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
      //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(QuestionRequest $request)
    {
        $question = new Question([
            'title' => $request->title,
            'user_id' => Auth::id(),
        ]);
        $question->save();

        return view('home.home', [
            'questions' => $this->getQuestions()
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
