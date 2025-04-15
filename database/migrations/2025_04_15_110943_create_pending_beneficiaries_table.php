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
        Schema::create('pending_beneficiaries', function (Blueprint $table) {
            $table->id();
            $table->string('national_id');
            
            $table->string('fullname');
           
            $table->string('phonenumber');
         
            $table->string('recipient_name');
         
            $table->string('recipient_phone');
         
            $table->string('recipient_nid');
          
            $table->integer('transfer_value');
          
            $table->integer('transfer_count');
   
            $table->date('recieve_date');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pending_beneficiaries');
    }
};
