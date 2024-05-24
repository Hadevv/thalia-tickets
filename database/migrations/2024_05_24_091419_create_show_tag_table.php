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
        Schema::create('show_tag', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->foreignId('show_id');
            $table->foreignId('tag_id');

            $table->foreign('show_id')->references('id')->on('shows')
                ->onDelete('restrict')
                ->onUpdate('cascade');

            $table->foreign('tag_id')->references('id')->on('tags')
                ->onDelete('restrict')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('show_tag');
    }
};
