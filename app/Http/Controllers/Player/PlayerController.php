<?php

namespace App\Http\Controllers\player;

use App\Http\Controllers\Controller;
use App\models\site\Game;
use Illuminate\Http\Request;
use App\models\admin\Question;
use Illuminate\Support\Facades\DB;

class PlayerController extends Controller
{

    const FOLDER = "site.players"; //Folder to the view

    public function index()
    {
        $topGamers = DB::table("games")
            ->selectRaw("sum(point) as point, players.name as player_name, players.surname as player_surname")
            ->join("players", "players.id", "=", "games.player_id")
            ->join("game_answers", "games.id", "=", "game_answers.game_id")
            ->groupBy("player_id", "players.name", "players.surname")
            ->orderBy("point", "desc")
            ->limit(10)
            ->get();
        return view(self::FOLDER . ".index", compact("topGamers"));
    }


}
