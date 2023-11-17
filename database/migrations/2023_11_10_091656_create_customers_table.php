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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('FirstName'); // Tên đầu
            $table->string('LastName'); // Tên cuối
            $table->string('Email')->unique(); // Email với ràng buộc unique
            $table->string('Phone')->nullable(); // Số điện thoại (cho phép giá trị null)
            $table->timestamps(); // Thêm cột created_at và updated_at tự động
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
