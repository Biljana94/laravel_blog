<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterPostsTableAddPublishedColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //fasada pomocu koje pristupamo tabeli nase baze (pristupamo tabeli posts i koloni published)
        Schema::table('posts', function (Blueprint $table) {
            $table->boolean('published')->default(0);//stavili smo default vrednost ako nista ne unosimo mi rucno, bice 0
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */

     //revertujemo ono sto smo radili, tj brisemo ih
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn('published');
        });
    }
}
