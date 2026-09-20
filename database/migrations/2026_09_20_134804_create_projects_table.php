<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->text('description')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });

        Schema::table('bugs', function (Blueprint $table) {
            $table->foreignId('project_id')->nullable()->after('id')->constrained('projects')->nullOnDelete();
        });

        // Migrate existing project strings into projects table
        $existingProjects = DB::table('bugs')
            ->whereNotNull('project')
            ->where('project', '!=', '')
            ->pluck('project')
            ->unique();

        foreach ($existingProjects as $projectName) {
            $projectId = DB::table('projects')->insertGetId([
                'name' => $projectName,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            DB::table('bugs')->where('project', $projectName)->update([
                'project_id' => $projectId,
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bugs', function (Blueprint $table) {
            $table->dropForeign(['project_id']);
            $table->dropColumn('project_id');
        });

        Schema::dropIfExists('projects');
    }
};
