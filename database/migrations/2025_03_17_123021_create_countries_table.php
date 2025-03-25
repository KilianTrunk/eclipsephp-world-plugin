<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('world_countries', function (Blueprint $table) {
            $table->string('id', 2)->primary();
            $table->string('a3_id', 3);
            $table->string('num_code', 3)->nullable();
            $table->string('name');
            $table->string('flag');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('world_countries');
    }
};
