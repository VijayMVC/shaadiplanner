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
            $table->string('slug');
            $table->string('contact')->nullable();
            $table->tinyInteger('display_contact')->nullable();
            $table->string('address_1')->nullable();
            $table->string('address_2')->nullable();
            $table->string('town')->nullable();
            $table->string('county')->nullable();
            $table->string('postcode')->nullable();
            $table->string('country')->nullable();
            $table->decimal('latitude',10,7);
            $table->decimal('longitude',10,7);
            $table->tinyInteger('display_address')->nullable();
            $table->string('phone')->nullable();
            $table->tinyInteger('display_phone')->nullable();
            $table->string('phone_2')->nullable();
            $table->tinyInteger('display_phone_2')->nullable();
            $table->string('email')->nullable();
            $table->string('website')->nullable();
            $table->string('description')->nullable();
            $table->integer('cat_id');
            $table->integer('cat2_id')->nullable();
            $table->string('listing_type');
            $table->integer('user_id')->unsigned()->foreign('user_id')->references('id')->on('users');
            $table->tinyInteger('status');
            $table->integer('visits');
            $table->timestamps();
            $table->softDeletes();
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
