<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysOnProductTagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_tag', function (Blueprint $table) {
            $table->foreign('product_id')
                ->references('id')->on('products')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table->foreign('tag_id')
                ->references('id')->on('tags')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_tag', function (Blueprint $table) {
            $table->dropForeign('product_tag_product_id_foreign');
            $table->dropForeign('product_tag_tag_id_foreign');
        });
    }
}
