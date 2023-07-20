<?php

namespace App\Http\Controllers\Home;

use App\Models\Question;
use App\Models\Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ResponseRequest;

class ResponseController extends Controller
{
    /**
     * Display a listing of the resource.
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
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ResponseRequest $request)
    {
        $response = new Response([
            'content' => $request->content,
            'question_id' => $request->question_id, // récupérer l'ID de la question du formulaire
            'user_id' => Auth::id(),
        ]);
        $response->save();
    
        // Rediriger vers la question à laquelle la réponse a été donnée
        return redirect()->route('home.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
