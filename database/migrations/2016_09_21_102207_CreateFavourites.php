<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFavourites extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::create('favourites', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('listing_id')->unsigned()->foreign('listing_id')->references('id')->on('listings');
			$table->integer('user_id')->unsigned()->foreign('user_id')->references('id')->on('users');
			$table->timestamps();
			$table->unique(['listing_id', 'user_id'], 'listing_id_user_unique');
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('favourites');
    }
}
