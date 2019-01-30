<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Validator;
use App\Questions;



class QuestionController extends Controller
{
    //
    public function index()
    {
        $questions = DB::select( DB::raw("SELECT questions.id,users.name,questions.heading,questions.description FROM `questions`INNER JOIN users ON users.id = questions.user_id") );
        return $questions;
    }
    public function getQuestion(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'question_id' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors());
        }
        $questions = DB::select( DB::raw("SELECT users.name,questions.id,questions.heading, questions.description FROM questions INNER JOIN users ON questions.user_id = users.id WHERE questions.id = $request[question_id]") );
        $answers = DB::select( DB::raw("SELECT users.name,answers.ans FROM answers INNER JOIN users ON answers.user_id = users.id WHERE answers.question_id = $request[question_id]") );
        // $answers = DB::select( DB::raw("SELECT users.name,answers.ans FROM answers INNER JOIN users ON answers.user_id = users.id WHERE answers.question_id = $request[question_id]") );
        $res = array();
        $res['questions'] = $questions;
        $res['answer'] = $answers;
        return $res;
    }

    public function store(Request $request) {

        $id = auth()->user()->id;
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'heading' => 'required',
            'description'=> 'required'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors());
        }
        Questions::create([
            'user_id' => $id,
            'heading' => $request->get('heading'),
            'description' => $request->get('description')
        ]);
        $res = array();
        $res['success'] = true;
        $res['reason'] = "Question created successfully";
        return $res;
    }

}
