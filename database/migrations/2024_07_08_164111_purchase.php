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
        Schema::create('purchase', function (Blueprint $table) {
            $table->id();
            $table->integer('supplierID');
            $table->integer('buyerID');
            $table->double('discount');
            $table->string('date');
        });
        Schema::create('purchaseDetail', function (Blueprint $table) {
            $table->id();
            $table->integer('purchaseID');
            $table->integer('productID');
            $table->integer('qty');
        });
        Schema::table('saleDetail',function(Blueprint $table){
            $table->dropColumn('discount');
        });
        Schema::table('sale',function(Blueprint $table){
            $table->double('discount');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
