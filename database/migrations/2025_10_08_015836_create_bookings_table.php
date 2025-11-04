<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            // UUID primary key to match tickets.id
            $table->uuid('id')->primary();

            // domain fields (based on App\Models\Booking::$fillable)
            $table->uuid('ticket_id');
            $table->string('seat_number', 20);
            $table->string('passenger_name', 255);
            $table->decimal('price', 10, 2);

            $table->timestamps();

            $table->index('ticket_id');

            // FK to tickets.id (tickets table uses UUID id)
            //$table->foreign('ticket_id')->references('id')->on('tickets')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};