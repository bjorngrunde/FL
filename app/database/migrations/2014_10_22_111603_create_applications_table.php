<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateApplicationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('Applys', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string('name');
            $table->string('lastName');
            $table->string('email')->unique();
            $table->string('username')->unique();
            $table->string('server');
            $table->string('talents');
            $table->string('armory');
            $table->enum('klass', ['death-knight','druid','hunter', 'mage','mage','monk', 'priest', 'paladin', 'rogue', 'shaman', 'warlock', 'warrior']);
            $table->longText('played');
            $table->longText('playClass');
            $table->longText('bio');
            $table->longText('raidExperience');
            $table->longText('reasonToApplyFl');
            $table->longText('oldGuild');
            $table->longText('progressRaid');
            $table->longText('attendance');
            $table->string('screenshot');
            $table->longText('other');
            $table->integer('status_id');
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
		Schema::drop('Applys');
	}

}
