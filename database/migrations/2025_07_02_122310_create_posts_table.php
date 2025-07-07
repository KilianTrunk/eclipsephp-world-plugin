<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('world_posts', function (Blueprint $table) {
            $table->id();
            $table->string('country_id', 2);
            $table->string('code');
            $table->string('name');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('country_id')
                ->references('id')
                ->on('world_countries')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('world_posts');
    }
};
