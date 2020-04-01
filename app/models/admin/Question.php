<?php

namespace App\models\admin;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    public function answers()
    {
        return $this->hasMany("App\models\admin\Answer", "question_id", "id");
    }
}
