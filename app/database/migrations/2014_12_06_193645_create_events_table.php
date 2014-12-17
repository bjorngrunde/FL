<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('raids', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('title');
            $table->string('backgroundImg');
            $table->text('description');
            $table->date('time');
            $table->string('startTime');
            $table->string('endTime');
            $table->string('mode')->nullable();
            $table->timestamps();
        });

        Schema::create('raidInstance', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('title');
            $table->string('backgroundImg');
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
        Schema::drop('raids');
        Schema::drop('raidInstance');

	}

}
