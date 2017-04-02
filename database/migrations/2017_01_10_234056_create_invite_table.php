<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInviteTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('invite', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')
                ->unsigned()
                ->nullable();
            $table->string('token')->unique();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
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
        Schema::drop('invite');
    }
}
