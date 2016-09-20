<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Kodeine\Metable\Metable;

class CreatePagesTable extends Migration
{
    use Metable;
    public function up()
    {
		Schema::create('pages', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('title')->unique();
			$table->string('slug')->unique();
			$table->text('content');
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
        Schema::drop('pages');
    }
}
