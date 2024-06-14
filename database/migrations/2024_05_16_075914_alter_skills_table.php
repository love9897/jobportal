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
        // Schema::create('skills', function (Blueprint $table) {
        //     $table->renameColumn('programming_languages', 'skills');
        // });
        Schema::table('skills', function (Blueprint $table) {
            $table->renameColumn('programming_languages', 'skills');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
