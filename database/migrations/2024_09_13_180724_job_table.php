<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class JobTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_queries', function (Blueprint $table) {
            $table->integer('id');
            $table->string('name', 250);
            $table->string('email', 250);
            $table->string('contact', 250);
            $table->string('appliedfor', 250);
            $table->string('portfolio', 250);
            $table->string('cv', 250);
            $table->timestamp('date_created')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contact_queries');
    }
}
