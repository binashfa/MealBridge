<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('donation_histories', function (Blueprint $table) {

            $table->id();

            $table->string('food_name');

            $table->integer('quantity');

            $table->date('distribution_date');

            $table->string('volunteer_name');

            $table->string('pickup_time');

            $table->string('pickup_deadline');

            $table->string('distribution_photo');

            $table->string('distribution_location');

            $table->string('community_receiver');

            $table->string('tracking_status');

            $table->string('donation_status');

            $table->timestamps();
            
            $table->decimal('current_latitude', 10, 7)->nullable();

            $table->decimal('current_longitude', 10, 7)->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('donation_histories');
    }
};
