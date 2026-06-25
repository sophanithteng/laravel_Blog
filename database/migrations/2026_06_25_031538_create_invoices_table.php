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
       Schema::create('invoices', function (Blueprint $table) {
            $table->id(); // Automatically acts as the primary 'InvoiceID'
            $table->string('client_name');
            $table->date('issue_date');
            $table->date('due_date');
            $table->decimal('balance_due', 10, 2); // 10 digits total, 2 after the decimal point
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
