<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPropertyLabelColumnToPropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('re_properties', function (Blueprint $table) {
            $table->string('label', 200)->nullable()->after('location');
        });

        Schema::table('re_properties_translations', function (Blueprint $table) {
            $table->string('label', 200)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('properties', function (Blueprint $table) {
            $table->dropColumn('label');
        });

        Schema::table('re_properties_translations', function (Blueprint $table) {
            $table->dropColumn('label');
        });
    }
}
