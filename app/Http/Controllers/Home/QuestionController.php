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
use Illuminate\Support\Facades\Storage;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     */

     private function getQuestions($request) {
        $query = Question::query();
        $ignoredQuestionIds = ignoredQuestion::where('user_id', Auth::id())->pluck('question_id');
        $query->whereHas('responses')->whereNotIn('id', $ignoredQuestionIds);
        if ($request->search) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        return $query->orderBy('created_at', 'desc')->paginate(8);
    }


    public function index(Request $request)
    {   
        $questions = $this->getQuestions($request);
        $now = Carbon::now();
        $tenMinutesAgo = $now->copy()->subMinutes(10);

        $recentQuestionsOfMe = Question::where('user_id', Auth::id())
                                        ->whereBetween('created_at',[$tenMinutesAgo, $now])
                                        ->latest('created_at')
                                        ->first();
        return view('home.home', [
            'questions' => $questions,
            'recentQuestionsOfMe' => $recentQuestionsOfMe,
        ]);
    }

    public function indexResponse()
    {   
        $questions = Question::whereDoesntHave('responses')->get();
        return view('home.response', [
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
            'questions' => $this->getQuestions( $request)
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
    public function destroy(Request $request)
    {
        $id = $request->id;

        $question = Question::findOrFail($id);
        $question->delete();

        return redirect()->route('home.index');
    }
}
