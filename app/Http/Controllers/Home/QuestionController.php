<?php

namespace App\Http\Controllers\Home;

use App\Models\User;
use App\Models\Question;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\QuestionRequest;
use Carbon\Carbon;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     */

    private function getQuestions() {
        return Question::orderBy('created_at', 'desc')->paginate(8);
    }

    public function index()
    {
        return view('home.home', [
            'questions' => $this->getQuestions(),
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
