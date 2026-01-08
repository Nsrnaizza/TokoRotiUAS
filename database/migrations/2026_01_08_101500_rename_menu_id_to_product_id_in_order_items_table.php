<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('order_items', function (Blueprint $table) {
            // drop foreign key on menu_id then rename to product_id and add new constraint
            if (Schema::hasColumn('order_items', 'menu_id')) {
                $table->dropForeign(['menu_id']);
                $table->renameColumn('menu_id', 'product_id');
                $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            }
        });
    }

    public function down()
    {
        Schema::table('order_items', function (Blueprint $table) {
            if (Schema::hasColumn('order_items', 'product_id')) {
                $table->dropForeign(['product_id']);
                $table->renameColumn('product_id', 'menu_id');
                $table->foreign('menu_id')->references('id')->on('menus')->onDelete('cascade');
            }
        });
    }
};
