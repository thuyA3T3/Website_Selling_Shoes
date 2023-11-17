<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('CustomerID'); // Khóa ngoại đến bảng Customers
            $table->foreign('CustomerID')->references('id')->on('customers')->onDelete('cascade'); // Khai báo foreign key và hành động xóa cascade khi bảng Customers bị xóa
            $table->dateTime('OrderDate'); // Ngày đặt hàng
            $table->decimal('TotalAmount', 10, 2); // Tổng số tiền với 10 chữ số tổng và 2 chữ số sau dấu thập phân
            $table->timestamps(); // Thêm cột created_at và updated_at tự động
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
