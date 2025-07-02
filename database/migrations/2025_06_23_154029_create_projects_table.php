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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->date('start_date');
            $table->date('end_date');
            $table->enum('priority', ['Low', 'Medium', 'High'])->default('Medium');
            $table->enum('status', [
                'Not started',
                'In progress',
                'Completed',
                'Cancelled',
                'Waiting Approval',
                'Delayed',
                'Under review'
            ])->default('Not started');
            $table->foreignId('unit_id')->constrained('units')->onDelete('restrict');
            $table->foreignId('project_manager_id')->constrained('users')->onDelete('restrict');
            $table->enum('type', ['HRM', 'Admin']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
