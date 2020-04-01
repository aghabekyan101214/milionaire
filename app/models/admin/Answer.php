<?php

namespace App\models\admin;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    public function questions()
    {
        return $this->belongsTo("App\models\admin\Question", "question_id", "id");
    }
}
