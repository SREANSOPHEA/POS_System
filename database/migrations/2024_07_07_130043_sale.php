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
        Schema::create('sale', function (Blueprint $table) {
            $table->id();
            $table->integer('customer');
            $table->integer('seller');
            $table->string('date');
        });
        Schema::create('saleDetail', function (Blueprint $table) {
            $table->id();
            $table->integer('saleID');
            $table->integer('productID');
            $table->integer('qty');
            $table->integer('price');
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
