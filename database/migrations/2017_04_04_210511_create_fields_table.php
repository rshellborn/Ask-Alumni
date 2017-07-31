<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fields', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
        });

        DB::table('fields')->insert([
            "name" => "Agriculture and Agricultural Sciences"
        ]);

        DB::table('fields')->insert([
            "name" => "Applied Sciences"
        ]);

        DB::table('fields')->insert([
            "name" => "Arts"
        ]);

        DB::table('fields')->insert([
            "name" => "Biology"
        ]);

        DB::table('fields')->insert([
            "name" => "Business"
        ]);

        DB::table('fields')->insert([
            "name" => "Chemistry"
        ]);

        DB::table('fields')->insert([
            "name" => "Computer Science"
        ]);

        DB::table('fields')->insert([
            "name" => "Earth and Space Sciences"
        ]);

        DB::table('fields')->insert([
            "name" => "Engineering and Technology"
        ]);

        DB::table('fields')->insert([
            "name" => "Geography"
        ]);

        DB::table('fields')->insert([
            "name" => "History"
        ]);

        DB::table('fields')->insert([
            "name" => "Humanities"
        ]);

        DB::table('fields')->insert([
            "name" => "Languages and Literature"
        ]);

        DB::table('fields')->insert([
            "name" => "Law"
        ]);

        DB::table('fields')->insert([
            "name" => "Medicine and Health Sciences"
        ]);

        DB::table('fields')->insert([
            "name" => "Performing Arts"
        ]);

        DB::table('fields')->insert([
            "name" => "Philosophy"
        ]);

        DB::table('fields')->insert([
            "name" => "Physics"
        ]);

        DB::table('fields')->insert([
            "name" => "Political Science"
        ]);

        DB::table('fields')->insert([
            "name" => "Psychology"
        ]);

        DB::table('fields')->insert([
            "name" => "Sciences"
        ]);

        DB::table('fields')->insert([
            "name" => "Social Sciences"
        ]);

        DB::table('fields')->insert([
            "name" => "Sociology"
        ]);

        DB::table('fields')->insert([
            "name" => "Visual Arts"
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fields');
    }
}
