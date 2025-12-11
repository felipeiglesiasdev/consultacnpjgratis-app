<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('removal_requests', function (Blueprint $table) {
            if (! Schema::hasColumn('removal_requests', 'cnpj')) {
                $table->string('cnpj', 14)->after('id');
            }
        });
    }

    public function down(): void
    {
        Schema::table('removal_requests', function (Blueprint $table) {
            if (Schema::hasColumn('removal_requests', 'cnpj')) {
                $table->dropColumn('cnpj');
            }
        });
    }
};
