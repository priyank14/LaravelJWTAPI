<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Validator;
use App\Answer;
class AnswerController extends Controller
{
    //
    public function getAnswer(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'question_id' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors());
        }
        $questions = DB::select( DB::raw("SELECT id,heading, description FROM `questions` WHERE id=$request[question_id]") );
        return $questions;
    }
    public function store(Request $request) {

        $id = auth()->user()->id;
        $validator = Validator::make($request->all(), [
            'question_id' => 'required',
            'user_id' => 'required',
            'ans'=> 'required'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors());
        }
        Answer::create([
            'question_id' => $request->get('question_id'),
            'user_id' => $id,
            'ans' => $request->get('ans')
        ]);
        $res = array();
        $res['success'] = true;
        $res['reason'] = "Answer submitted successfully";
        return $res;
    }
}
