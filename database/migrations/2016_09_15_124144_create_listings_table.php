<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateListingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('listings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('business_name');
            $table->string('uri');
            $table->string('contact');
            $table->tinyInteger('display_contact');
            $table->string('address_1');
            $table->string('address_2');
            $table->string('town');
            $table->string('county');
            $table->string('postcode');
            $table->string('country');
            $table->decimal('latitude',9,2);
            $table->decimal('longitude',9,2);
            $table->tinyInteger('display_address');
            $table->string('phone');
            $table->tinyInteger('display_phone');
            $table->string('phone_2');
            $table->tinyInteger('display_phone_2');
            $table->string('email');
            $table->string('website');
            $table->string('description');
            $table->integer('category');
            $table->integer('category_2');
            $table->string('listing_type');
            $table->integer('user_id');
            $table->tinyInteger('status');
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
        Schema::drop('listings');
    }
}
