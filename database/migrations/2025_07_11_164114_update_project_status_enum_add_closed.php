<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
         DB::statement("ALTER TABLE projects MODIFY status ENUM(
            'Not started',
            'In progress',
            'Completed',
            'Cancelled',
            'Waiting Approval',
            'Delayed',
            'Under review',
            'Closed'
        ) DEFAULT 'Not started'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
         DB::statement("ALTER TABLE projects MODIFY status ENUM(
            'Not started',
            'In progress',
            'Completed',
            'Cancelled',
            'Waiting Approval',
            'Delayed',
            'Under review'
        ) DEFAULT 'Not started'");
    
    }
};
