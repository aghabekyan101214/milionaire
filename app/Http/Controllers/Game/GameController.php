<?php

namespace App\Http\Controllers\game;

use App\Http\Controllers\Controller;
use App\models\admin\Answer;
use App\models\site\Game;
use Illuminate\Http\Request;
use App\models\admin\Question;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GameController extends Controller
{

    const QUESTION_COUNT = 5; // Number, how many questions should be shown

    const FOLDER = "site.game"; //Folder to the view

//    Starting the game
    public function index()
    {
        $questions = Question::whereHas("answers")
        ->with(["answers" => function($query){
            $query->selectRaw("id, question_id, title")->inRandomOrder();
        }])
        ->inRandomOrder()
        ->paginate(self::QUESTION_COUNT);

        return view(self::FOLDER . ".index", compact("questions"));
    }

//    managing answered questions
    public function manageAnswers(Request $request)
    {
        $data = json_decode($request->getContent()); // Data from ajax

//        check if all questions are answered
        if(count($data) < self::QUESTION_COUNT) {
            return response()->json([
                "error" => "Please, Answer all the questions"
            ], 422);
        }
        $pushData = $this->getPushData($data);
        $point = $this->getPoints($pushData);

        DB::beginTransaction();
        // Creating new game
        $game = new Game();
        $game->player_id = Auth::user()->id;
        $game->save();
        $game->gameAnswer()->createMany($pushData);

        DB::commit();

        $response = array(
            "pushData" => $pushData,
            "point" => $point
        );
        return response()->json($response);
    }

//    Forming the data to be pushed db
    private function getPushData(array $data)
    {
        $arr = [];
        foreach ($data as $d) {
            $wrightAnswers = Answer::where(["question_id" => $d->questionId, "is_wright_answer" => 1])->get();
            $answer = Answer::with("questions")->find($d->answerId);
            $arr[] = array(
                "answer_id" => $d->answerId,
                "is_wright_answer" => $answer->is_wright_answer ?? 0,
                "wright_answers" => $this->getWrightAnswerIds($wrightAnswers),
                "point" => $answer->is_wright_answer ? $answer->questions->point : 0
            );
        }
        return $arr;
    }

//    getting wright answer id as array
    private function getWrightAnswerIds(Collection $wrightAnswers)
    {
        $arr = [];
        foreach ($wrightAnswers as $wrightAnswer) {
            $arr[] = $wrightAnswer->id;
        }
        return $arr;
    }

//    counting the point of current game
    private function getPoints(array $arr)
    {
        $point = 0;
        foreach ($arr as $a) {
            if($a['is_wright_answer']) {
                $answer = Answer::with("questions")->find($a['answer_id']);
                $point += $answer->questions->point;
            }
        }
        return $point;
    }
}
