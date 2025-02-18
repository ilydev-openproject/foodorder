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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->onDelete('cascade'); // ID order
            $table->foreignId('payment_method_id')->constrained()->onDelete('cascade'); // Metode pembayaran
            $table->decimal('amount', 10, 2); // Jumlah pembayaran
            $table->enum('status', ['pending', 'completed', 'failed'])->default('pending'); // Status pembayaran
            $table->foreignId('processed_by')->nullable()->constrained('users')->onDelete('set null'); // Kasir yang memproses pembayaran
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
