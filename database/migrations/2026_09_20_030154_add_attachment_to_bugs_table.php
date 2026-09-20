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
        Schema::table('bugs', function (Blueprint $table) {
            $table->string('attachment')->nullable()->after('description');
            $table->string('attachment_name')->nullable()->after('attachment');
            $table->unsignedBigInteger('attachment_size')->nullable()->after('attachment_name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bugs', function (Blueprint $table) {
            $table->dropColumn(['attachment', 'attachment_name', 'attachment_size']);
        });
    }
};
