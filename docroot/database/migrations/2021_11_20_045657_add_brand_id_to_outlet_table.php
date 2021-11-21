<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBrandIdToOutletTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('outlet', function (Blueprint $table) {
            $table->unsignedBigInteger('brandId')->nullable()->after('id');
            $table->foreign('brandId')->on('brand')->references('id')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('outlet', function (Blueprint $table) {
            $table->dropForeign(['brandId']);
            $table->dropColumn(['brandId']);
        });
    }
}
