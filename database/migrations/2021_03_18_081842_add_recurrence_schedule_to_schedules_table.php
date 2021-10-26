<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRecurrenceScheduleToSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('schedules', function (Blueprint $table) {
            $table->integer('recurrence_times')->after('end_time')->nullable();
            $table->integer('recurrence_interval')->after('recurrence_times')->nullable();
            $table->foreignId('schedule_id')->after('recurrence_interval')->nullable()->constrained();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('schedules', function (Blueprint $table) {
            $table->dropColumn('recurrence_times');
            $table->dropColumn('recurrence_interval');
            $table->dropForeign('schedules_schedule_id_foreign');
        });
    }
}
