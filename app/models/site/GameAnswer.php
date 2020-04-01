<?php

namespace App\models\site;

use Illuminate\Database\Eloquent\Model;

class GameAnswer extends Model
{
    protected $fillable = ["game_id", "answer_id", "is_wright_answer", "point"];
    public $timestamps = false;
}
