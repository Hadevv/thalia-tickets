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
        Schema::create('shows', function (Blueprint $table) {
            $table->id();
            $table->string('title', 255);
            $table->string('slug', 60)->unique();
            $table->text('description')->nullable();
            $table->string('poster_url', 255)->nullable();
            $table->foreignId('location_id')->nullable();
            $table->boolean('bookable')->default(false);
            // $table->decimal('price', 10, 2)->nullable();
            // $table->timestamp('created_at')->useCurrent();
            // $table->timestamp('updated_at')->nullable();

            $table->year('created_in');
            $table->smallInteger('duration')->unsigned();

            $table->foreign('location_id')->references('id')->on('locations')
                ->onDelete('restrict')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shows');
    }
};
