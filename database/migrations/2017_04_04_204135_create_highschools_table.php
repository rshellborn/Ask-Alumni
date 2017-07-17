<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHighschoolsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('highschools', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
        });

        DB::table('highschools')->insert([
            "name" => "Archbishop Carney Regional Secondary School"
        ]);

        DB::table('highschools')->insert([
            "name" => "Centennial Secondary School"
        ]);

        DB::table('highschools')->insert([
            "name" => "Gleneagle Secondary School"
        ]);

        DB::table('highschools')->insert([
            "name" => "Heritage Woods Secondary School"
        ]);

        DB::table('highschools')->insert([
            "name" => "Pinetree Secondary School"
        ]);

        DB::table('highschools')->insert([
            "name" => "Port Moody Secondary School"
        ]);

        DB::table('highschools')->insert([
            "name" => "Riverside Secondary School"
        ]);

        DB::table('highschools')->insert([
            "name" => "Terry Fox Secondary School"
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('highschools');
    }
}
