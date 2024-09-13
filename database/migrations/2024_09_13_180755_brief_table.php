<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class BriefTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('brief_queries', function (Blueprint $table) {
            $table->integer('id');
            $table->string('name', 250);
            $table->string('email', 250);
            $table->string('contact', 250);
            $table->string('company', 250);
            $table->string('budget', 250);
            $table->string('webUrl', 250);
            $table->string('date', 250);
            $table->text('message');
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
