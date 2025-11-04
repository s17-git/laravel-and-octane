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
        Schema::create('tickets', function (Blueprint $table) {
            // use UUID primary key
            $table->uuid('id')->primary();

            // domain fields
            // UUID foreign keys
            $table->uuid('bus_id');
            $table->uuid('user_id');

            // FK constraints (assumes buses.id and users.id are UUIDs)
           // $table->foreign('bus_id')->references('id')->on('buses')->cascadeOnDelete();
            //$table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
            $table->string('seat_number', 20);
            $table->string('passenger_name', 255);
            $table->decimal('price', 10, 2);

            $table->timestamps();

            $table->index(['bus_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
