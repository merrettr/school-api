<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReconcileTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('reconcile', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('file_name');
            $table->string('file_path');
            $table->integer('created')->unsigned();
            $table->integer('updated')->unsigned();
            $table->integer('deleted')->unsigned();
            $table->boolean('was_success');
            $table->string('error');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('reconcile');
    }
}
