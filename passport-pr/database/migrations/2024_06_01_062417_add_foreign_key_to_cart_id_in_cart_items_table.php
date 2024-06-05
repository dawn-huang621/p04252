<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cart_items', function (Blueprint $table) {
            // 確保 cart_id 列已存在並且是無符號的
            if (!Schema::hasColumn('cart_items', 'cart_id')) {
                $table->unsignedBigInteger('cart_id')->change();
            }

            // 清理無效的 cart_id 數據
            // DB::table('cart_items')
            //     ->whereNotIn('cart_id', function ($query) {
            //         $query->select('id')->from('carts');
            //     })
            //     ->delete();

            // 添加外鍵約束
            $table->foreign('cart_id')->references('id')->on('carts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cart_items', function (Blueprint $table) {
            $table->dropForeign(['cart_id']);
        });
    }
};
