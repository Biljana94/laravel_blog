<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('author');
            $table->text('text');

            $table->unsignedInteger('post_id');//ova fnc znaci da nesto ne moze biti negativno
            $table->foreign('post_id') //komentar za koji post je vezan
                ->references('id') //referencira id
                ->on('posts') //na tabeli posts
                ->onDelete('cascade'); //kad se obrise post da se obrisu svi komentari na tom postu

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comments');
    }
}
