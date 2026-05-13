<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pay', function (Blueprint $table) {
            $table->id();

            // Thông tin đặt tour (tham chiếu sang booking)
            $table->foreignId('booking_id')->constrained()->onDelete('cascade');
            $table->foreignId('tour_id')->constrained('tours')->onDelete('cascade');

            $table->unsignedInteger('quantity');
            $table->decimal('total_amount', 15, 2);

            // pending -> paid/failed/cancelled
            $table->string('status')->default('pending');

            $table->string('payment_provider')->nullable();
            $table->string('payment_reference')->nullable();
            $table->timestamp('paid_at')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pay');
    }
};

