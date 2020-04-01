<?php

namespace App\models\site;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    public function gameAnswer()
    {
        return $this->hasMany("App\models\site\GameAnswer", "game_id", "id");
    }
}
