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
        Schema::create('resturants', function (Blueprint $table) {
            $table->id('resturant_id');
            $table->string('resturant_name');
            $table->string('heading');
            $table->string('description');
            $table->string('open_interval');
            $table->string('open_time_duration_from');
            $table->string('open_time_duration_to');
            $table->boolean('booking_status')->default(1);
            $table->string('image')->nullable();
            $table->string('fb');
            $table->string('insta');
            $table->string('x');
            $table->string('you_tube');
            $table->foreignId('created_by')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resturants');
    }
};
