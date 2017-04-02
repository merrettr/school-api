<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBehaviourCategoryIdToBehaviour extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('behaviour', function (Blueprint $table) {
            $table->bigInteger('behaviour_category_id')
                ->after('id')
                ->unsigned()
                ->nullable();
            $table->boolean('is_enabled')
                ->after('description')
                ->default('1');

            $table->foreign('behaviour_category_id')
                ->references('id')
                ->on('behaviour_category')
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
        Schema::table('behaviour', function (Blueprint $table) {
            $table->dropForeign('behaviour_behaviour_category_id_foreign');
            $table->dropColumn('is_enabled');
            $table->dropColumn('behaviour_category_id');
        });
    }
}
