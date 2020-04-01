<?php

namespace App\Http\Controllers\admin;

use App\models\admin\Answer;
use App\models\admin\Question;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AnswerController extends Controller
{


    const FOLDER = "admin.answers"; //    Path To the View Folder

    const TITLE = "Answers"; //    Resource Title

    const ROUTE = "/admin/answers"; //    Resource Route

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $answers = Answer::with("questions")->orderBy("id", "desc")->paginate(1000);
        $route = self::ROUTE;
        $title = self::TITLE;
        return view(self::ROUTE . ".index", compact("answers", "route", "title"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $route = self::ROUTE;
        $title = self::TITLE;
        $action = "create";
        $questions = Question::all();
        return view(self::ROUTE . ".create", compact("route", "title", "action", "questions"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            "title" => "required|max:191",
            "question_id" => "required|integer",
            "is_wright_answer" => "integer|max:1|min:0"
        ]);

        $answer = new Answer();
        $answer->question_id = $request->question_id;
        $answer->title = $request->title;
        $answer->is_wright_answer = $request->is_wright_answer ?? 0;
        $answer->save();

        return redirect(self::ROUTE);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\models\admin\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function show(Answer $answer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\models\admin\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function edit(Answer $answer)
    {
        $route = self::ROUTE;
        $title = self::TITLE;
        $action = "edit";
        $questions = Question::all();
        return view(self::ROUTE . ".create", compact("route", "title", "action", "answer", "questions"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\models\admin\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Answer $answer)
    {
        $request->validate([
            "title" => "required|max:191",
            "question_id" => "required|integer",
            "is_wright_answer" => "integer|max:1|min:0"
        ]);

        $answer->question_id = $request->question_id;
        $answer->title = $request->title;
        $answer->is_wright_answer = $request->is_wright_answer ?? 0;
        $answer->save();

        return redirect(self::ROUTE);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\models\admin\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Answer $answer)
    {
        $answer->delete();
        return redirect(self::ROUTE);
    }
}
