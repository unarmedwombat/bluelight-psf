<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lots', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('framework_id')->index();
            $table->string('title')->nullable();
            $table->unsignedInteger('min_value')->nullable()->default('0');
            $table->unsignedInteger('max_value')->nullable()->default('1000000000');
            $table->timestamps();
            $table->unsignedBigInteger('updated_by_id')->nullable()->index('lots_updated_by_index');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lots');
    }
}
