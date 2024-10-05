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
        Schema::create('leave_form', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('leave_application_type', 255)->nullable();
            $table->timestamp('leave_apply_date')->nullable();
            $table->string('leave_type')->nullable();
            $table->timestamp('leave_date_from')->nullable();
            $table->timestamp('leave_date_to')->nullable();
            $table->string('leave_half_day')->nullable();
            $table->integer('leave_day')->nullable();
            $table->string('leave_reason')->nullable();
            $table->string('leave_manager_email')->nullable();
            $table->string('leave_cc_email')->nullable();
            $table->bigInteger('leave_contact_no')->nullable();
            $table->string('leave_contact_address1')->nullable();
            $table->string('leave_contact_address2')->nullable();
            $table->string('leave_contact_address3')->nullable();
            $table->string('leave_city')->nullable();
            $table->integer('leave_pincode')->nullable();
            $table->string('leave_medical_certificate')->nullable();
            $table->integer('status')->default(0);
            $table->tinyInteger('read')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leave_form');
    }
};
