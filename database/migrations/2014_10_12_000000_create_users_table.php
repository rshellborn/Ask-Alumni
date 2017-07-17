<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('role')->default('admin');
            $table->string('permissions')->default('user');
            $table->boolean('active')->default(false);
            $table->string('type')->nullable();
            $table->text('highSchool')->nullable();
            $table->text('bio')->nullable();
            $table->text('fields')->nullable();
            $table->text('schools')->nullable();
            $table->text('degrees')->nullable();
            $table->boolean('inSchool')->nullable();
            $table->boolean('allowMessage')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
