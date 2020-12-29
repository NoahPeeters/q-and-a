<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;
use App\Models\Question;

class QuestionController extends Controller {
    public static $placeholderQuestions = [
        "What is it like to be vegan?",
        "Where is the best vegan restaurant?",
        "As a vegan, where do you get your protein?",
        "I'd like to become vegan, but cheese is tasty. What can I do about this?"
    ];

    public function index(Request $request) {
        $onlyShowUnanswered = $request->query('unanswered') == 'true';

        $questions = Question::latest();

        if ($onlyShowUnanswered) {
            $questions = $questions
                ->whereNotExists(function ($query) {
                    $query->select(DB::raw(1))
                            ->from('answers')
                            ->whereColumn('answers.question_id', 'questions.id');
                    });
        }
        $questions = $questions
                ->simplePaginate(15)
                ->appends($request->input());


        $placeholderQuestion = Arr::random(self::$placeholderQuestions);

        $toggleUnansweredURL = $request->fullUrlWithQuery([
            'unanswered' => $onlyShowUnanswered ? 'false' : 'true',
            'page' => null
        ]);

        return view('dashboard', [
            'placeholderQuestion' => $placeholderQuestion,
            'questions' => $questions,
            'toggleUnansweredTitle' => $onlyShowUnanswered ? 'Show all' : 'Show unanswered only',
            'toggleUnansweredURL' => $toggleUnansweredURL
        ]);
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
