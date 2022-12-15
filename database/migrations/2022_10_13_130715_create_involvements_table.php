<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvolvementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('involvements', function (Blueprint $table) {
            $table->id();
            $table->string('act_code')->unique();
            $table->string('report_code')->unique();
            $table->date('date_notification');
            $table->dateTime('date_received')->nullable();
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->string('task_type');
            $table->enum('work_status', ['done', 'is_performed', 'execution_suspended']);
            $table->string('place_execution');
            $table->json('coordinates');
            $table->float('examined');
            $table->json('persons');
            $table->json('ammunition');
            $table->integer('all_ammunition');
            $table->float('tnt');
            $table->integer('detonator');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('involvements');
    }
};
