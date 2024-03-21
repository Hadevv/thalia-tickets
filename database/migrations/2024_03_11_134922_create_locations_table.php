<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints(); // Désactiver les contraintes de clé étrangère temporairement

        Schema::create('locations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('locality_id')->nullable();
            $table->string('slug', 60)->unique();
            $table->string('designation', 60);
            $table->string('address', 255)->nullable();
            $table->string('website', 255)->nullable();
            $table->string('phone', 30)->nullable();
            $table->timestamps();
        });

        Schema::table('locations', function (Blueprint $table) {
            // Ajouter une contrainte de clé étrangère à la colonne locality_id
            $table->foreign('locality_id')
                  ->references('id')
                  ->on('localities')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
        });

        Schema::enableForeignKeyConstraints(); // Réactiver les contraintes de clé étrangère
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('locations');
    }
}
