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
        Schema::table('projects', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable()->after('id');
            // assegno la foreign key alla colonna creata
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->CascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
             // elimino la foreign key
             $table->dropForeign(['user_id']);
             // elimino la colonna delle foreign key
             $table->dropColumn('user_id');
        });
    }
};
