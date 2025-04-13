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
        Schema::create('beneficiaries', function (Blueprint $table) {
            $table->id();
            $table->string('national_id');
            $table->string('h_national_id')->nullable();
            $table->string('fullname');
            $table->string('h_fullname')->nullable();
            $table->string('phonenumber');
            $table->string('h_phonenumber')->nullable();
            $table->string('recipient_name');
            $table->string('h_recipient_name')->nullable();
            $table->string('recipient_phone');
            $table->string('h_recipient_phone')->nullable();
            $table->string('recipient_nid');
            $table->string('h_recipient_nid')->nullable();
            $table->integer('transfer_value');
            $table->integer('h_transfer_value')->nullable();
            $table->integer('transfer_count');
            $table->integer('h_transfer_count')->nullable();
            $table->date('recieve_date');
            $table->foreignId('project_id')->constrained('projects');
            
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrentOnUpdate();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('beneficiaries');
    }
};
