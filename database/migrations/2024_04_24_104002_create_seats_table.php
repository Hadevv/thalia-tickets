<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\SeatStatusEnum;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('seats', function (Blueprint $table) {
            $table->id();
            $table->string('seat_number')->unique();
            $table->string('status')->default(SeatStatusEnum::AVAILABLE);
            $table->timestamps();
        });

        for ($i = 1; $i <= 20; $i++) {
            \App\Models\Seat::create([
                'seat_number' => 'S' . $i,
                'status' => SeatStatusEnum::AVAILABLE,
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seats');
    }
};

