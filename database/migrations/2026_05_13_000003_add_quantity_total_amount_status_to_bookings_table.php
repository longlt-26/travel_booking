<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            if (!Schema::hasColumn('bookings', 'quantity')) {
                $table->unsignedInteger('quantity')->default(1);
            }

            if (!Schema::hasColumn('bookings', 'total_amount')) {
                $table->decimal('total_amount', 15, 2)->default(0);
            }

            if (!Schema::hasColumn('bookings', 'status')) {
                $table->string('status')->default('pending');
            }

            if (!Schema::hasColumn('bookings', 'payment_provider')) {
                $table->string('payment_provider')->nullable();
            }

            if (!Schema::hasColumn('bookings', 'payment_reference')) {
                $table->string('payment_reference')->nullable();
            }

            if (!Schema::hasColumn('bookings', 'paid_at')) {
                $table->timestamp('paid_at')->nullable();
            }
        });
    }

    public function down(): void
    {
        // Không xóa cột trong down để tránh mất dữ liệu khi rollback.
    }
};

