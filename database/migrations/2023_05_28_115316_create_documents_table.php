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
        Schema::create('documents', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->foreignId('user_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();
            $table->string('description')
                ->nullable();
            $table->string('file');
            $table->string('type', 10);
            $table->string('verification', 15)
                ->nullable();
            $table->string('status')
                ->nullable();
            $table->uuid('record_id')->nullable();
            $table->foreign('record_id')
                ->references('id')
                ->on('records')
                ->onDelete('set null')
                ->onUpdate('cascade');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
