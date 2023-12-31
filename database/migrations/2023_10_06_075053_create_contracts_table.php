<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('contracts', function (Blueprint $table) {
            $table->softDeletes();
            $table->id();
            $table->string('contract_number');
            $table->string('agreement_file')->nullable();
            $table->string('company_name')->nullable();
            $table->string('type');
            $table->string('status')->default('not started');
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->date('completed_date')->nullable();
            $table->decimal('amount', 10, 2)->nullable(); // Decimal field with 10 total digits and 2 decimal places
            $table->text('description')->nullable();
            $table->unsignedBigInteger('client_id')->nullable();
            // Define foreign key constraints
            $table->foreign('client_id')->references('id')->on('users')->onDelete('cascade');

            $table->unsignedBigInteger('pm_id')->nullable();
            // Define foreign key constraints
            $table->foreign('pm_id')->references('id')->on('employees')->onDelete('cascade');

            $table->unsignedBigInteger('devlead_id')->nullable();
            // Define foreign key constraints
            $table->foreign('devlead_id')->references('id')->on('employees')->onDelete('cascade');


            $table->unsignedBigInteger('qalead_id')->nullable();
            // Define foreign key constraints
            $table->foreign('qalead_id')->references('id')->on('employees')->onDelete('cascade');

            $table->unsignedBigInteger('employee_id')->nullable();
            // Define foreign key constraints
            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contracts');
    }
};
