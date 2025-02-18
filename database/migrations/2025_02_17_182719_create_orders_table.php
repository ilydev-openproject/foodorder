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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('table_id')->constrained()->onDelete('cascade'); // Meja tempat pesanan dilakukan
            $table->enum('status', ['pending', 'cooking', 'ready', 'completed', 'cancelled'])->default('pending'); // Status pesanan
            $table->decimal('total_price', 10, 2)->default(0); // Total harga pesanan
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null'); // Karyawan yang menangani pesanan
            $table->timestamp('ordered_at')->useCurrent(); // Waktu pesanan dibuat
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
