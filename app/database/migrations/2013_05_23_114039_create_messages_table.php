<?php

use Illuminate\Database\Migrations\Migration;

class CreateMessagesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('messages', function($table) 
		{
			$table->increments('id');
			$table->integer('conversation_id')->unsigned();
			$table->integer('user_id')->unsigned();
			$table->text('body');
			$table->timestamps();

			$table->foreign('conversation_id')->references('id')->on('conversations');
			$table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('messages');
	}

}