<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('world_country_in_special_region', function (Blueprint $table) {
            $table->date('start_date')->default(DB::raw('CURRENT_DATE'))->change();
        });
    }

    public function down(): void
    {
        Schema::table('world_country_in_special_region', function (Blueprint $table) {
            $table->date('start_date')->change();
        });
    }
};
