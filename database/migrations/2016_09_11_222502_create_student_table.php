<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('student', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('reconcile_id')
                ->unsigned()
                ->nullable();
            $table->string('first_name');
            $table->string('last_name');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('reconcile_id')
                ->references('id')
                ->on('reconcile')
                ->onDelete('set null')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('student');
    }
}
