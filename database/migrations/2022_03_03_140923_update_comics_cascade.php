<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateComicsCascade extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('comics', function (Blueprint $table) {
            $table->dropForeign('comics_user_id_foreign');
            $table->foreign('user_id')
                ->references('id')
                ->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->dropForeign('comics_category_id_foreign');
            $table->foreign('category_id')
                ->references('id')
                ->on('categories')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('user_infos', function (Blueprint $table) {
            $table->dropForeign('user_infos_user_id_foreign');
            $table->foreign('user_id')
                ->references('id')
                ->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
