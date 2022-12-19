<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFrameworkRegionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('framework_region', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('framework_id')->index('framework_id_index');
            $table->unsignedBigInteger('region_id')->index('region_id_index');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('framework_region');
    }
}
