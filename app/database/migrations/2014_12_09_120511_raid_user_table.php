<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RaidUserTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('raid_user', function ($table) {
            $table->increments('id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->integer('raid_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('raid_id')->references('id')->on('raids');
            $table->text('raid_role');
            $table->text('raid_status');
        });

    }

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::table('raid_user', function (Blueprint $table) {
            $table->dropForeign('raid_user_user_id_foreign');
            $table->dropForeign('raid_user_raid_id_foreign');
       });

        Schema::drop('raid_user');
	}

}
