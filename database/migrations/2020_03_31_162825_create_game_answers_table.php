<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGameAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('game_answers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger("game_id");
            $table->foreign("game_id")->references("id")->on("games")->onDelete("cascade")->onUpdate("cascade");
            $table->unsignedBigInteger("answer_id");
            $table->foreign("answer_id")->references("id")->on("answers")->onDelete("cascade")->onUpdate("cascade");
            $table->unsignedTinyInteger("is_wright_answer");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('player_points');
    }
}
