<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('donation_claims', function (Blueprint $table) {

            $table->id();

            $table->foreignId('donation_id')
                  ->constrained('donations')
                  ->onDelete('cascade');

            $table->foreignId('community_id')
                  ->constrained('communities')
                  ->onDelete('cascade');

            $table->integer('claimed_quantity');

            $table->enum('status', [
                'requested',
                'approved',
                'distribution',
                'completed'
            ])->nullable();

            $table->string('proof_photo')->nullable();

            $table->string('supplier_proof_photo')->nullable();

            $table->string('community_proof_photo')->nullable();

            $table->dateTime('delivery_date')->nullable();

            $table->string('courier_name')->nullable();

            $table->string('courier_phone', 20)->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('donation_claims');
    }
};