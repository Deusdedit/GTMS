<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewColumnsToActivity extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('activities', function (Blueprint $table) {
            $table->unsignedBigInteger('activity_from_user_id');
            $table->unsignedBigInteger('duration');
            $table->dateTime('assigned_date')->nullable();
            $table->dateTime('start_assign_date')->nullable();
            $table->dateTime('start_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('activities', function (Blueprint $table) {
            $table->dropColumn('assigned_date');
            $table->dropColumn('start_assign_date');
            $table->dropColumn('duration');
            $table->dropColumn('activity_from_user_id');
            $table->dropColumn('start_date');
        });
    }
}
