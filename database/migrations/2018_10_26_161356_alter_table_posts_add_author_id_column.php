<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTablePostsAddAuthorIdColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function(Blueprint $table) {
            $table->unsignedInteger('author_id'); //$id mora uvek biti pozitivan broj
            $table->foreign('author_id') //sekundarni kljuc author_id
                ->references('id') //povezujemo sa referencom $id
                ->on('users') //na users tabeli
                ->onDelete('cascade'); //i da se brise kaskadno
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function(Blueprint $table) {
            $table->dropForeign('posts_author_id_foreign');
            // $table->dropForeign(['author_id']);
            $table->dropColumn('author_id');
        });
    }
}
