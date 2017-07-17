<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDegreesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('degrees', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
        });

        DB::table('degrees')->insert([
            "name" => "Associates"
        ]);

        DB::table('degrees')->insert([
            "name" => "Bachelors"
        ]);

        DB::table('degrees')->insert([
            "name" => "Certificate"
        ]);

        DB::table('degrees')->insert([
            "name" => "Diploma"
        ]);

        DB::table('degrees')->insert([
            "name" => "Doctorate"
        ]);

        DB::table('degrees')->insert([
            "name" => "Masters"
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('degrees');
    }
}
