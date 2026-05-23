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

            $table->integer('remaining_quantity')->default(0);

            $table->date('expired_date');

            $table->text('description')->nullable();

            $table->string('category')->nullable();

            $table->text('pickup_location')->nullable();

            $table->dateTime('pickup_time')->nullable();

            $table->string('food_photo')->nullable();

            $table->enum('status', [
                'pending',
                'requested',
                'distribution',
                'completed'
            ])->default('pending');

            $table->foreignId('supplier_id')
                  ->constrained('suppliers')
                  ->onDelete('cascade');

            $table->string('proof_photo')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('donations');
    }
};