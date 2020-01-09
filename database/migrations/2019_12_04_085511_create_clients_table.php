<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClientsTable extends Migration {

	public function up()
	{
		Schema::create('clients', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name')->unique();
			$table->string('email')->unique();
			$table->string('password');
			$table->string('phone');
			$table->timestamps('date_of_birth');
			$table->timestamps('last_donation_date');
			$table->string('pin_code')->nullable();
			$table->string('api_token' , 60)->unique();
			$table->integer('blood_type_id')->unsigned();
			$table->integer('city_id');
			$table->boolean('is_active')->default(1);
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('clients');
	}
}
