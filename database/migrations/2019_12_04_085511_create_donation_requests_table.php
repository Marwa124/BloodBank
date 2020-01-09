<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDonationRequestsTable extends Migration {

	public function up()
	{
		Schema::create('donation_requests', function(Blueprint $table) {
			$table->increments('id');
			$table->string('patient_name')->nullable();
			$table->string('patient_age');
			$table->integer('bags_num')->unsigned();
			$table->string('hospital_name')->nullable();
			$table->string('hospital_address');
			$table->decimal('latitude', 10,8);
			$table->decimal('longitude', 10,8);
			$table->string('phone');
			$table->text('notes')->nullable();
			$table->integer('blood_type_id')->unsigned();
			$table->integer('city_id')->unsigned();
			$table->integer('client_id')->unsigned();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('donation_requests');
	}
}
