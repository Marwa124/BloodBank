<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePostsTable extends Migration {

	public function up()
	{
		Schema::create('posts', function(Blueprint $table) {
			$table->increments('id');
			$table->string('title')->nullable();
			$table->text('content');
			$table->text('image');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('posts');
	}
}