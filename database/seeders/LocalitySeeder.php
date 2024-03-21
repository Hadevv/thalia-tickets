<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use App\Models\Locality;
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
        Locality::truncate();

        Schema::create('locations', function (Blueprint $table) {
            $table->id();
            $table->string('slug', 60)->unique();
            $table->string('designation', 60);
            $table->string('address', 255);
            $table->foreignId('locality_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->string('website', 255)->nullable();
            $table->string('phone', 20)->nullable();
            $table->string('email', 255)->nullable();
        });
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
