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
        Schema::create('stations', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name')->unique();
            $table->string('adress')->nullable();
            $table->string('city')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('code')->unique();
            $table->string('contact_person')->nullable();
            $table->string('contact_phone')->nullable();

            $table->string('status')->default('active'); // active, inactive
            $table->timestamps();

            //commition rate
            $table->decimal('commission_rate', 5, 2)->default(0.00);
            $table->uuid('manager_id')->nullable();
            $table->foreign('manager_id')->references('id')->on('users')->onDelete('set null');

            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('stations', function (Blueprint $table) {
            $table->dropForeign(['manager_id']);
            $table->dropColumn('manager_id');
        });
        Schema::dropIfExists('stations');

    }
};
