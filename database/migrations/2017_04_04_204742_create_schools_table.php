<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSchoolsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schools', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
        });

        DB::table('schools')->insert([
            "name" => "British Columbia Institute of Technology"
        ]);

        DB::table('schools')->insert([
            "name" => "Douglas College"
        ]);

        DB::table('schools')->insert([
            "name" => "Emily Carr University of Art and Design"
        ]);

        DB::table('schools')->insert([
            "name" => "Kwantlen Polytechnic University"
        ]);

        DB::table('schools')->insert([
            "name" => "Langara College"
        ]);

        DB::table('schools')->insert([
            "name" => "Simon Fraser University"
        ]);

        DB::table('schools')->insert([
            "name" => "Trinity Western University"
        ]);

        DB::table('schools')->insert([
            "name" => "The Art Institute of Vancouver"
        ]);

        DB::table('schools')->insert([
            "name" => "University of British Columbia"
        ]);

        DB::table('schools')->insert([
            "name" => "University of Victoria"
        ]);

        DB::table('schools')->insert([
            "name" => "University of the Fraser Valley"
        ]);

        DB::table('schools')->insert([
            "name" => "Vancouver Community College"
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('schools');
    }
}
