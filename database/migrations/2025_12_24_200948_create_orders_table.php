<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('slug')->unique();
            $table->uuid('customer_id');
            $table->uuid('hero_id');
            $table->string('current_rank');
            $table->string('target_rank');
            $table->integer('price');
            $table->enum('status', ['Pending', 'In Progress', 'Completed', 'Cancelled'])->default('Pending');
            $table->timestamps();

            // Foreign keys dengan cascade
            $table->foreign('customer_id')
                  ->references('id')
                  ->on('customers')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');

            $table->foreign('hero_id')
                  ->references('id')
                  ->on('heroes')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
