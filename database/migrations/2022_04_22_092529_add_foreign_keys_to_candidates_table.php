<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToCandidatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('candidates', function (Blueprint $table) {
            $table->foreign(['contractor_id'])->references(['id'])->on('contractors')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['opportunity_id'])->references(['id'])->on('opportunities')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('candidates', function (Blueprint $table) {
            $table->dropForeign('candidates_contractor_id_foreign');
            $table->dropForeign('candidates_opportunity_id_foreign');
        });
    }
}
