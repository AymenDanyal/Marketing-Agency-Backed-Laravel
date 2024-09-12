<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->integer('id');
            $table->string('slug', 260);
            $table->string('title', 260);
            $table->integer('cat_id');
            $table->text('thumbnail');
            $table->text('desktop_banner');
            $table->text('mob_banner');
            $table->text('content');
            $table->text('summary');
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
        Schema::dropIfExists('blogs');
    }
};
