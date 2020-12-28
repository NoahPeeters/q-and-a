<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Question;
use App\Models\Answer;

class AnswerController extends Controller {
    public function create(Question $question, Request $request) {
        $this->validate($request, [
            'answer' => ['required', 'min:5']
        ]);

    	$answer = new Answer();
    	$answer->text = $request->answer;
        $answer->question_id = $question->id;
        $answer->author = $request->author;
    	$answer->save();
    	return \Redirect::back();
    }
}
