<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFrameworksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('frameworks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->unsignedBigInteger('organisation_id');
            $table->boolean('is_dps')->nullable()->default(false);
            $table->string('url')->nullable();
            $table->date('expiry')->nullable();
            $table->string('extension_options')->nullable();
            $table->string('award_notice_title')->nullable();
            $table->string('award_notice_url')->nullable();
            $table->string('calloff_routes')->nullable();
            $table->text('contract_types')->nullable();
            $table->string('levy')->nullable();
            $table->text('fee_notes')->nullable();
            $table->string('contact')->nullable();
            $table->string('job_title')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->unsignedBigInteger('updated_by_id')->nullable()->index('frameworks_updated_by_index');
            $table->unsignedBigInteger('deleted_by_id')->nullable()->index('frameworks_deleted_by_index');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('frameworks');
    }
}
