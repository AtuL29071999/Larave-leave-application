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
        Schema::create('leavesbalance', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('total_leave');
            $table->decimal('sick_leave', 4, 2);
            $table->decimal('avl_sick_leave', 4, 2);
            $table->decimal('earned_leave', 4, 2);
            $table->decimal('avl_earned_leave', 4, 2);
            $table->integer('rh_leave');
            $table->decimal('avl_rh_leave', 4, 2);
            $table->timestamp('leave_taken_at')->nullable(); // New field
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leavesbalance');
    }
};
