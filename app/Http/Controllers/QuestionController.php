<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Arr;
use App\Models\Question;

class QuestionController extends Controller {
    public static $placeholderQuestions = [
        "What is it like to be vegan?",
        "Where is the best vegan restaurant?",
        "As a vegan, where do you get your protein?",
        "I'd like to become vegan, but cheese is tasty. What can I do about this?"
    ];

    public function index() {
        $questions = Question::orderBy('created_at', 'DESC')->get();
        $placeholderQuestion = Arr::random(self::$placeholderQuestions);

        return view('dashboard', compact('questions'))
            ->with('placeholderQuestion', $placeholderQuestion);
    }

    public function create(Request $request) {
        $this->validate($request, [
            'question' => ['required', 'min:5', 'regex:/(^.*\?$)/u']
        ]);

    	$question = new Question();
    	$question->text = $request->question;
    	$question->save();
    	return redirect("/questions/{$question->id}\/"); 
    }

    public function view(Question $question) {
        return view('view', compact('question'));
    }
}
