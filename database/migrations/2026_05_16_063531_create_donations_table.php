<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('donations', function (Blueprint $table) {

            $table->id();

            $table->string('food_name');

            $table->integer('quantity');

            $table->date('expired_date');

            $table->text('description')->nullable();

            $table->string('supplier_name');

            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('donations');
    }
};