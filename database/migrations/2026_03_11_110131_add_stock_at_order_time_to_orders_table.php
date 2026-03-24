<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->integer('stock_at_order_time')->after('quantity')->default(0)->comment('Stock quantity at the time of order');
            $table->decimal('unit_price', 10, 2)->after('stock_at_order_time')->default(0)->comment('Unit price at the time of order');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['stock_at_order_time', 'unit_price']);
        });
    }
};
