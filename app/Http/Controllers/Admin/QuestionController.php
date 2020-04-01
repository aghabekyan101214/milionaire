<?php

namespace App\Http\Controllers\admin;

use App\models\admin\Question;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class QuestionController extends Controller
{


    const FOLDER = "admin.questions"; //    Path To the View Folder

    const TITLE = "Questions"; //    Resource Title

    const ROUTE = "/admin/questions"; //    Resource Route

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questions = Question::orderBy("id", "desc")->paginate(1000);  //It Isn't the best idea to pull all data from db
        $route = self::ROUTE;
        $title = self::TITLE;
        return view(self::ROUTE . ".index", compact("questions", "route", "title"));
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
        return view(self::ROUTE . ".create", compact("route", "title", "action"));
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
            "point" => "required|integer|min:5|max:25"
        ]);

        $question = new Question();
        $question->title = $request->title;
        $question->point = $request->point;
        $question->save();

        return redirect(self::ROUTE);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\models\admin\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\models\admin\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    {
        $route = self::ROUTE;
        $title = self::TITLE;
        $action = "edit";
        return view(self::ROUTE . ".create", compact("route", "title", "action", "question"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\models\admin\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Question $question)
    {
        $request->validate([
            "title" => "required|max:191",
            "point" => "required|integer|min:5|max:25"
        ]);

        $question->title = $request->title;
        $question->point = $request->point;
        $question->save();

        return redirect(self::ROUTE);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\models\admin\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
        $question->delete();
        return redirect(self::ROUTE);
    }
}
