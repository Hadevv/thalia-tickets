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
        Schema::table('users', function (Blueprint $table) {
            $table->string('lastname', 60)->after('name');
            $table->string('login', 30)->after('id');
            $table->string('langue', 2)->after('email');
            $table->string('name', 60)->change();
            $table->renameColumn('name', 'firstname');
            $table->unique('login', 'users_login_unique');
        });
    }
    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropUnique('users_login_unique');
            $table->renameColumn('firstname', 'name');
            $table->dropColumn('langue');
            $table->dropColumn('login');
            $table->dropColumn('lastname');
        });
    }
};
